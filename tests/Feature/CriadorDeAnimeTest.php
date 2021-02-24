<?php

namespace Tests\Feature;

use App\Anime;
use App\Services\CriadorDeAnime;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CriadorDeAnimeTest extends TestCase
{
    use RefreshDatabase;
    
    public function testCriarSerie()
    {
        $criadorDeAnime = new CriadorDeAnime();
        $nomeAnime = 'Nome de teste';
        $animeCriado = $criadorDeAnime->criarAnime($nomeAnime,1,1);

        $this->assertInstanceOf(Anime::class,$animeCriado);
        $this->assertDatabaseHas('animes',['nome' => $nomeAnime]);
        $this->assertDatabaseHas('temporadas',['anime_id' => $animeCriado->id, 'numero' => 1]);
        $this->assertDatabaseHas('episodios', ['numero' => 1]);
    }
}
