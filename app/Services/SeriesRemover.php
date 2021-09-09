<?php

namespace App\Services;

use App\Events\SerieApagada;
use App\Jobs\ExcluirCapaSerie;
use App\Models\Episodio;
use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SeriesRemover {
    public function removeSerie($serie): string
    {
        $serie = Serie::find($serie)->first();
        
        DB::transaction(function () use ($serie){ // colocando a query em uma transaction, assim se ocorrer algum erro em algumas das operações, tudo será voltado ao estado anterior
            $this->removeSerieSeasons($serie);

            $serieObj = (object) $serie->toArray(); // criando um objeto, por se for passado um obj Série, vai dar erro por ele já ter sido deletado no momento da consulta dele

            /* $event = new SerieApagada($serieObj);
            event($event); */

            ExcluirCapaSerie::dispatch($serieObj);

            $serie->delete();
        });

        return $serie->name;
    }

    private function removeSerieSeasons($serie)
    {
        $serie->temporadas()->each(function (Temporada $temporada) { 
            $this->removeSeasonEpisodes($temporada);
            $temporada->delete();
        });
    }

    private function removeSeasonEpisodes(Temporada $temporada){
        $temporada->episodios()->each(function (Episodio $episodio) { 
            $episodio->delete();
        });
    }

}