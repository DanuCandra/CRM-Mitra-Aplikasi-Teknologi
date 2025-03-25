<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
{
    if (!Auth::check()) {
        return redirect('/login'); // Jika tidak login, kembalikan ke login
    }

    $userRole = Auth::user()->role;

    // Jika role sesuai dengan parameter middleware, lanjutkan
    if ($userRole === $role) {
        return $next($request);
    }

    // Redirect berdasarkan role
    if ($userRole === 'sales') {
        return redirect('/sales');
    } elseif ($userRole === 'admin') {
        return redirect('/admin');
    } elseif ($userRole === 'superadmin') {
        return redirect('/superadmin');
    }

    return redirect('/404'); // Jika role tidak dikenali
}

}
