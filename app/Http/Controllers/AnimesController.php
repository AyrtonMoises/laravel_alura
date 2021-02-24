<?php

namespace App\Http\Controllers;

use App\Anime;
use Illuminate\Http\Request;
use App\Http\Requests\AnimesFormRequest;
use App\Services\{CriadorDeAnime, RemovedorDeAnime};
use Illuminate\Support\Facades\Auth;


class AnimesController extends Controller {

    public function index(Request $request){

        $animes = Anime::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');

        return view('animes.index', compact('animes','mensagem') );
    }

    public function create(){
        return view('animes.create');
    }

    public function store(AnimesFormRequest $request, CriadorDeAnime $criadorDeAnime ){

        $anime = $criadorDeAnime->criarAnime($request->nome,$request->qtd_temporadas,$request->ep_por_temporada);

        $request->session()
        ->flash('mensagem',
            "Anime {$anime->id} e suas temporadas e episódios criado com sucesso {$anime->nome}"
        );
        return redirect()->route('listar_animes');
    }

    public function destroy(Request $request, RemovedorDeAnime $removedorDeAnime){

        $nomeAnime = $removedorDeAnime->removerAnime($request->id);
        $request->session()
        ->flash('mensagem',
            "Anime $nomeAnime removido com sucesso"
        );    

        return redirect()->route('listar_animes');
    }

    public function editaNome(int $id, Request $request){
        $novoNome = $request->nome;
        $anime = Anime::find($id);
        $anime->nome = $novoNome;
        $anime->save();
    }
}