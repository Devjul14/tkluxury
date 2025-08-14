<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class SetLocaleFromSession
{
    public function handle($request, Closure $next)
    {

        if (Session::has('locale')) {
            dd(session()->getId());
            app()->setLocale(Session::get('locale'));
        }
        return $next($request);
    }
}
