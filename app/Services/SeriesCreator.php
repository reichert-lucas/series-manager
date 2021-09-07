<?php

namespace App\Services;

use App\Models\Serie;

class SeriesCreator {
    public function createSerie($name, $qtdTemporadas, $epPorTemporada)
    {
        $serie = Serie::create(['name' => $name]);

        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            for ($j = 1; $j <= $epPorTemporada; $j++) {
                $temporada->episodios()->create(['numero' => $j]);
            }
        }

        return $serie;
    }
}