@extends('layout')

@section('cabecalho')
Temporadas de {{ $anime->nome }}
@endsection

@section('conteudo')
<ul class="list-group">
    @foreach($temporadas as $temporada)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <a href="/temporadas/{{$temporada->id}}/episodios">
            {{ $temporada->numero }}º Temporada
        </a>
        <span class="badge badge-secondary">
            {{ $temporada->getEpisodiosAssistidos()->count() }} / {{ $temporada->episodios->count() }}
        </span>
    </li>   
    @endforeach
</ul>
@endsection
