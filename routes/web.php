<?php

Route::get('/animes', 'AnimesController@index')->name('listar_animes');
Route::get('/animes/criar', 'AnimesController@create')->name('form_criar_anime')->middleware('autenticador');
Route::post('/animes/criar', 'AnimesController@store')->middleware('autenticador');
Route::delete('/animes/{id}','AnimesController@destroy')->middleware('autenticador');
Route::get('/animes/{animeId}/temporadas','TemporadasController@index');
Route::post('/animes/{id}/editaNome','AnimesController@editaNome')->middleware('autenticador');
Route::get('/temporadas/{temporada}/episodios','EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistir','EpisodiosController@assistir')->middleware('autenticador');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');
Route::get('/sair', function(){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('entrar');
});