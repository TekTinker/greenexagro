<?php

namespace App\Http\Middleware;

use Closure;

class Employee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role == 'employee') {
            return $next($request);
        } else {
            return Redirect::Route('home')->with('info-danger', 'Please login first to access this page!');
        }
    }
}
