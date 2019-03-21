<?php

namespace App\Http\Middleware;

use App;
use Closure;

class SetLanguage
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
        if ($request->input('lang')) {
            App::setLocale($request->input('lang'));
        } else {
            $lang = locale_accept_from_http($request->headers->get('accept-language'));
            $arr = config('app.locales');
            App::setLocale(locale_lookup($arr, $lang, true, config('app.locale')));
        }
        return $next($request);
    }
}
