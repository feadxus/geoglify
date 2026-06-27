<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get current locale from session, if not set use 'en' as default
        // We don't use config('app.locale') here to allow explicit control
        $locale = session('locale');

        if (!$locale) {
            // First time: use config or default to 'en'
            $locale = config('app.locale', 'en');
            // Store in session for future requests
            session(['locale' => $locale]);
        }

        // Validate locale
        if (!in_array($locale, ['en', 'pt', 'zh'])) {
            $locale = 'en';
            session(['locale' => $locale]);
        }

        // Set application locale
        App::setLocale($locale);

        return $next($request);
    }
}
