<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->check() && auth()->user()->bidang === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, redirect atau beri respon error
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
