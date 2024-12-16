<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->username === 'ciptaindonesia') {
            return $next($request);
        }

        return redirect('/'); // Redirect ke halaman utama jika bukan admin
    }
}
