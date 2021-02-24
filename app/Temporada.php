<?php

namespace App;

use Illuminate\Database\Eloquent\{Model, Collection};

class Temporada extends Model
{
    protected $fillable = ['numero'];
    public $timestamps = false;

    public function anime(){

        return $this->belongsTo(Anime::class);
    }

    public function episodios(){

        return $this->hasMany(Episodio::class);
    }

    public function getEpisodiosAssistidos(): Collection
    {
        return $this->episodios->filter(function(Episodio $episodio){
            return $episodio->assistido;
        });
    }

}
