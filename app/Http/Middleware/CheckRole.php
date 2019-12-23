<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        echo Route::currentRouteName();
        exit();
        $result = $request->user()->hasRole($role);
        if(!$result) {
            redirect('/');
        }
        return $next($request);
    }
}
