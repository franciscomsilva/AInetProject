<?php

namespace App\Http\Middleware;

use Closure;

class isAtivo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() && $request->user()->ativo == 1){
            return $next($request);
        }
        return $next($request);
    }
}
