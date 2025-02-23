<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{


    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->role == 1) {
            return redirect()->route('bands.index')
                ->with('error', 'Acesso negado. Você precisa ser administrador.');
        }

        return $next($request);
    }
}
