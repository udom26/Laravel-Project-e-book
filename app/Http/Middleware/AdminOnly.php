<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roles = session('user_roles', []);
        if (!in_array('admin', $roles)) {
            return redirect('/')->with('error', 'ห้ามเข้า !!!');
        }
        return $next($request);
    }
}
