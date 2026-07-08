<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        // Nonce généré avant le rendu de la vue pour être disponible dans les templates
        $nonce = base64_encode(random_bytes(16));
        app()->instance('csp-nonce', $nonce);

        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=(), usb=()');

        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        // Admin : unsafe-eval requis pour TinyMCE + unsafe-inline pour les handlers onclick.
        // NOTE: nonce + unsafe-inline = unsafe-inline ignoré par le navigateur (spec CSP).
        // On n'utilise donc pas de nonce côté admin pour ne pas casser les scripts inline.
        // Front  : nonce uniquement, pas d'unsafe-inline ni d'unsafe-eval
        $isAdmin = str_starts_with($request->path(), 'admin');
        $scriptSrc = $isAdmin
            ? "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net"
            : "script-src 'self' 'nonce-{$nonce}' https://cdn.jsdelivr.net";

        $csp = implode('; ', [
            "default-src 'self'",
            $scriptSrc,
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
