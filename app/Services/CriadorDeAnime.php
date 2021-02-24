<?php

namespace App\Services;
use App\Anime;
use Illuminate\Support\Facades\DB;

class CriadorDeAnime
{
    public function criarAnime(string $nomeAnime, int $qtdTemporadas, int $epPorTemporada): Anime
    {
        DB::beginTransaction();
        $anime = Anime::create(['nome' => $nomeAnime]);
        $this->criarTemporadas($qtdTemporadas,$epPorTemporada,$anime);
        DB::commit();

        return $anime;
    }

    private function criarTemporadas(int $qtdTemporadas, int $epPorTemporada, Anime $anime)
    {
        for($i = 1; $i <= $qtdTemporadas; $i++)
        {
            $temporada = $anime->temporadas()->create(['numero' => $i]);
            $this->criarEpisodios($epPorTemporada, $temporada);
        }
    }

    private function criarEpisodios(int $ep_por_temporada, \Illuminate\Database\Eloquent\Model $temporada): void
    {
        for($j = 1; $j <= $ep_por_temporada; $j++)
        {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }

}