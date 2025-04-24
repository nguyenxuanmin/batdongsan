<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Company;

class SystemAuth
{
    public function handle($request, Closure $next)
    {
        $company = Company::all();
        if(!count($company)){
                return redirect()->route('system');
        }

        return $next($request);
    }
}
