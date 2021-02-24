<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;

class Autenticador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    /**
     * verifica a rota para nao ficar em loop 
     * caso o middleware seja global em outro caso
    */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->is('entrar','registrar') && !Auth::check()){
            return redirect('/entrar');
        }
        return $next($request);
    }
}
