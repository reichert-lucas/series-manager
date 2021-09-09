<?php

namespace App\Services;

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
            $serie->delete();

            if ($serie->capa) {
                Storage::delete($serie->capa);
            }
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