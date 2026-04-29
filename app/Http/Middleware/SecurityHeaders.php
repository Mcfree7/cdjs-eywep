<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Empêche le clickjacking (iframes non autorisées)
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Empêche le MIME-sniffing des navigateurs
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Protection XSS pour anciens navigateurs
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Contrôle les infos de provenance envoyées dans les requêtes
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Restreint l'accès aux APIs sensibles du navigateur
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=(), usb=()');

        // HSTS : force HTTPS pour 1 an (uniquement activé si la connexion est déjà en HTTPS)
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        // Content Security Policy
        // unsafe-inline  : requis pour les blocs <style> inline et le thème Consulo
        // unsafe-eval    : requis pour TinyMCE (éditeur admin)
        // frame-src      : YouTube, Vimeo (vidéos hero), Google Maps (contact), PDF iframes
        $csp = implode('; ', [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval'",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net https://fonts.bunny.net",
            "font-src 'self' data: https://fonts.gstatic.com https://cdn.jsdelivr.net https://fonts.bunny.net",
            "img-src 'self' data: blob:",
            "frame-src 'self' https://www.youtube.com https://player.vimeo.com https://www.google.com",
            "connect-src 'self'",
            "object-src 'none'",
            "base-uri 'self'",
            "form-action 'self'",
            "frame-ancestors 'self'",
            "upgrade-insecure-requests",
        ]);
        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
