<?php

namespace App\Http\Middleware;

use App\Models\Language\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request Request.
     * @param \Closure $next Next.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($language = $request->server('HTTP_ACCEPT_LANGUAGE')) {
            $language = Language::whereAlpha2($language)->first();
        }
        if (!$language && $user = $request->user()) {
            $language = $user->language;
        }
        App::setLocale($language ? $language->getAlpha2() : config('app.locale'));

        return $next($request);
    }
}
