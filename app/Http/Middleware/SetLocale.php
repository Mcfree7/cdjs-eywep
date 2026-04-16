<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public const SUPPORTED_LOCALES = ['fr', 'pt', 'en'];
    public const DEFAULT_LOCALE    = 'fr';

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale', self::DEFAULT_LOCALE);

        if (!in_array($locale, self::SUPPORTED_LOCALES)) {
            $locale = self::DEFAULT_LOCALE;
        }

        app()->setLocale($locale);
        session(['locale' => $locale]);

        // Injecte automatiquement {locale} dans tous les appels route()
        URL::defaults(['locale' => $locale]);

        return $next($request);
    }
}
