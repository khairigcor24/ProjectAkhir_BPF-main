<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil user yang sedang login
        $user = Auth::user();

        // Pastikan user tidak null (double check)
        if (!$user) {
            return redirect()->route('login');
        }

        // Cek apakah user memiliki role admin
        if (!$user->isAdmin()) {
            abort(403, 'Unauthorized. Hanya Admin yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}






