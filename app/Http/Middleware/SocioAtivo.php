<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

class SocioAtivo
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
        throw new AccessDeniedException('Unauthorized.');
    }
}
