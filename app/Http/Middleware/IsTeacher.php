<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lorris
 * Date: 22/11/2017
 * Time: 16:37
 */

namespace App\Http\Middleware;


use Illuminate\Support\Facades\Auth;
use Closure;

class IsTeacher
{
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role == 1)
            return $next($request);

        return redirect('/register');
    }
}