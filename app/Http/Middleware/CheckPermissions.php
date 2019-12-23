<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions)
    {
        $result = $request->user()->hasPermissions($permissions);
        if(!$result) {
            redirect('/');
        }
        return $next($request);
    }
}
