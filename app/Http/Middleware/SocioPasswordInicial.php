<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class SocioPasswordInicial
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
        if($request->user() && $request->user()->password_inicial == 1) {


            return redirect()
                ->route('user.password')
                ->with('errors', new MessageBag(['Para sua segurança altere a usa password inicial!']));

        }

        return $next($request);
    }
}
