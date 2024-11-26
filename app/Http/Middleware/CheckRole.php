<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (Auth::check()) {
            if ($roles[0] === '666') {
                return $next($request);
            }

            // Cek apakah pengguna memiliki salah satu peran yang diizinkan
            $userRoles = Auth::user()->roles->id;

            if (in_array($userRoles, $roles)) {
                // Pengguna memiliki salah satu peran yang diizinkan, lanjutkan ke rute yang diminta
                return $next($request);
            }
        }

        // Jika pengguna tidak memiliki peran yang diizinkan, arahkan mereka kembali atau tampilkan pesan kesalahan
        return redirect('/sign-in')->with('error', 'Unauthorized.');
    }
}
