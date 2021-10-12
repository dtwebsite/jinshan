<?php

namespace App\Http\Middleware;
use Session;
use Closure;
use Config;
use App;

class Language
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
        if (Session::has('locale')) {
            $locale = Session::get('locale', Config::get('app.locale'));
        } else {
            $locale = config('app.fallback_locale');
            Session::put('locale', $locale);
        }

        App::setLocale($locale);

        return $next($request);
    }
}
