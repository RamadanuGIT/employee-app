<?php

namespace App\Http\Middleware;

// use auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Cek_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth::check()) {
            return redirect()->route('login')->with('error','Gagal, kamu belum login');
        }

        $user = Auth::user();

        if ($user) {
            return $next($request);
        }
    }
}
