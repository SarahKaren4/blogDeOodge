<?php

namespace App\Http\Middleware;

use Closure;
use App;

class MultiLingual
{

    public function handle($request, Closure $next)
    {
        // Make sure current locale exists.
        $locale = $request->segment(1);

        if (!array_key_exists($locale, config('app.locales'))) {
            $segments = $request->segments();
            array_unshift($segments, config('app.fallback_locale'));

            return redirect()->to(implode('/', $segments));
        }

        App::setLocale($locale);

        return $next($request);
    }

}
