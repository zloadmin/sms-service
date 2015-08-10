<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Config;
use Session;

class Languages
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

        $raw_locale = Session::get('locale');

        if (in_array(Session::get('locale'), Config::get('app.locales'))) {
            $locale = $raw_locale;
        } else $locale = Config::get('app.locale');

        App::setLocale($locale);

        return $next($request);
    }
}
