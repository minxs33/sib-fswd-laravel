<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, \Closure $next, $role)
    {
        $explode = explode('|', $role);

        foreach ($explode as $key => $value) {
            if ($request->user()->role == $value) {
                return $next($request);
            }
        }

        // dd($request->user()->role);

        if ($request->user()->role) {
            return abort(403, 'Unauthorized action');
        } else {
            return abort(403, 'User role not found');
        }
    }
}
