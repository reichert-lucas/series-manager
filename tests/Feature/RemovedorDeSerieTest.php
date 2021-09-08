<?php

namespace Tests\Feature;

use App\Services\SeriesCreator;
use App\Services\SeriesRemover;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RemovedorDeSerieTest extends TestCase
{

    use RefreshDatabase;

    /** @var Serie */
    private $serie;

    protected function setUp(): void
    {
        parent::setUp();
        
        $serieCreator = new SeriesCreator();
        $nomeSerie = 'Nome da série';
        $this->serie = $serieCreator->createSerie($nomeSerie, 1, 1);
        
    }

    public function testRemoverUmaSerie()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);
        $serieRemover = new SeriesRemover();
        $nomeSerie = $serieRemover->removeSerie($this->serie->id);
        $this->assertIsString($nomeSerie);
        $this->assertEquals('Nome da série', $this->serie->name);
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);

    }

}
