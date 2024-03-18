<?php

namespace Eolica\NovaLocaleSwitcher\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocaleSwitcher
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request):mixed  $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        app()->setLocale('en');

        if ($user && array_key_exists($user->locale, config('nova.locales'))) {
            app()->setLocale($user->locale);
        }

        return $next($request);
    }
}
