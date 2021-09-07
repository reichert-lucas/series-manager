<?php

namespace App\Services;

use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Support\Facades\DB;

class SeriesCreator {
    public function createSerie($name, $qtdTemporadas, $epPorTemporada)
    {

        $serie = null;

        DB::beginTransaction(); // é o mesmo que usar o método transaction que foi usado no SeriesRemover, porém assim não precisar referenciar todos os dados para dentro da função
            $serie = Serie::create(['name' => $name]);
            $this->createSeasons($serie, $qtdTemporadas, $epPorTemporada);
        DB::commit();
        
        
        return $serie;
    }

    private function createSeasons(Serie $serie, $qtdTemporadas, $epPorTemporada)
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->createEpisodes($temporada, $epPorTemporada);
        }
    }

    private function createEpisodes(Temporada $temporada, $epPorTemporada)
    {
        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}