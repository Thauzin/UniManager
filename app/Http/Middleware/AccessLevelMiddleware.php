<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessLevelMiddleware
{
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        $user = auth()->user();

        if (!$user) {

            return redirect()
                ->route('login')
                ->with('error', 'Faça login para acessar o sistema.');
        }

        if (!in_array($user->access_level_id, $levels)) {

            return redirect()
                ->back()
                ->with('error', 'Você não tem permissão para acessar essa rota.');
        }

        return $next($request);
    }
}