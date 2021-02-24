<?php

namespace App\Services;
use App\{Anime, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

class RemovedorDeAnime
{
    public function removerAnime(int $animeId): string
    {
        $nomeAnime = '';
        DB::transaction(function() use($animeId, $nomeAnime){
            $anime = Anime::find($animeId);
            $nomeAnime = $anime->nome;

            $this->removerTemporadas($anime);
            $anime->delete();
            
        });

        return $nomeAnime;
    }

    private function removerTemporadas(Anime $anime): void
    {
        $anime->temporadas->each(function (Temporada $temporada) {  
           $this->removerEpisodios($temporada);
           $temporada->delete();
        });
        
        
    }

    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });
        
    }
}