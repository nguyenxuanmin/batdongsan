<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAuth
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return redirect()->route('admin');
        }

        return $next($request);
    }
}
