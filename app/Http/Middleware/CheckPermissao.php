<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermissao
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se está logado, se não tiver redireciona
        if ( !auth()->check() )
        return redirect()->route('login');

        /*
        * Verifica se o nivel de permissão
        */
        // Recupera o nivel de permissão do usuário logado
        $permissao = auth()->user()->nivelPermissao;

        // Verifica se o nivel de permissão é Gernte, caso não se redireciona para a Home Page
        if ( $permissao != '1' )
            return redirect('/dashboard');


        // Permite que continue (Caso não entre em nenhum dos if acima)...
        return $next($request);
    }
}
