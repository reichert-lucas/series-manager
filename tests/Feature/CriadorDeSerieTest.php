<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\SeriesCreator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CriadorDeSerieTest extends TestCase
{

    use RefreshDatabase;

    public function testCriarSerie()
    {
        $serieCreator = new SeriesCreator();
        $nomeSerie = 'Nome de teste';
        $serieCriada = $serieCreator->createSerie($nomeSerie, 1, 1);

        $this->assertInstanceOf(Serie::class, $serieCriada);
        $this->assertDatabaseHas('series', ['name' => $nomeSerie]);
        $this->assertDatabaseHas('temporadas', ['serie_id' => $serieCriada->id, 'numero'=> 1]);
        $this->assertDatabaseHas('episodios', ['numero'=> 1]);
    }
}
