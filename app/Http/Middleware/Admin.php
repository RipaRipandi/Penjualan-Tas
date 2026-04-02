<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <--- import Auth
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Gunakan Auth facade
        if (!Auth::check()) {
            abort(401, 'Harus login terlebih dahulu');
        }

        $user = Auth::user(); // Ambil user yang login

        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak: hanya admin yang bisa mengakses halaman ini');
        }

        return $next($request);
    }
}