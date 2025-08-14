<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

class SetLocaleFromSession
{
    public function handle($request, Closure $next)
    {

        Log::info([
            'path'         => $request->path(),
            'session_id'   => session()->getId(),
            'session_data' => session()->all(),
            'cookies'      => $request->cookies->all(),
        ]);

        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}
