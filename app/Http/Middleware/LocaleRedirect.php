<?php

namespace App\Http\Middleware;

use Closure;


class LocaleRedirect
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
        session_start();
        $langs = array_keys ( config('langs') );
        $default = $langs[0];
        $locale = $request->segment(1);
        if (in_array($locale, $langs)) {
            $_SESSION['localeCode'] = $locale;
            return $next($request);
        } else {
            if (isset($_SESSION['localeCode'])) {
                if (in_array($_SESSION['localeCode'], $langs)) {
                    $lang = $_SESSION['localeCode'];
                } else {
                    $lang = $default;
                }
            } else {
                $_SESSION['localeCode'] = $default;
                $lang = $default;
            }

            // for  command php artisan serve
            $newUrl = '/'. $lang . '/' . $request->path();

            // for htdocs launch
            // $newUrl = str_replace(env('REDIRECT'), env('REDIRECT').'/'. $lang, $request->fullUrl());

            return redirect($newUrl);
        }
    }
}
