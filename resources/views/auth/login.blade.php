<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Connexion | {{ $adminSettings->company_name ?? 'EYWEP-CDJS' }}</title>

        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
            crossorigin="anonymous"
        />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.css') }}" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body.auth-admin {
                min-height: 100vh;
                background-color: #f0f2f5;
                background-image:
                    radial-gradient(circle at 20% 20%, rgba(99, 102, 241, 0.06) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(16, 185, 129, 0.05) 0%, transparent 50%),
                    url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23000000' fill-opacity='0.025'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }

            .auth-shell {
                min-height: 100vh;
                display: grid;
                place-items: center;
                padding: 2rem 1rem;
            }

            .auth-card {
                width: min(100%, 440px);
                border: 0;
                border-radius: 1.25rem;
                overflow: hidden;
                box-shadow:
                    0 0 0 1px rgba(0, 0, 0, 0.05),
                    0 1rem 2rem rgba(0, 0, 0, 0.08),
                    0 2rem 4rem rgba(0, 0, 0, 0.04);
                background: #fff;
            }

            .auth-logo-area {
                padding: 2.5rem 2rem 1.5rem;
                text-align: center;
                border-bottom: 1px solid #f1f3f5;
            }

            .auth-logo-wrap {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.25rem;
            }

            .auth-logo-wrap img {
                height: 60px;
                width: auto;
                object-fit: contain;
            }

            .auth-logo-icon {
                width: 60px;
                height: 60px;
                border-radius: 1rem;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: #f8f9fa;
                border: 1px solid #e9ecef;
                color: #495057;
                font-size: 1.6rem;
            }

            .auth-org-name {
                font-size: 1rem;
                font-weight: 700;
                color: #212529;
                letter-spacing: 0.02em;
                margin-bottom: 0.25rem;
            }

            .auth-tagline {
                font-size: 0.825rem;
                color: #868e96;
            }

            .auth-form-area {
                padding: 2rem;
            }

            .auth-form-area .form-control {
                border-radius: 0.625rem;
                padding: 0.625rem 0.875rem;
                border-color: #dee2e6;
                font-size: 0.9rem;
            }

            .auth-form-area .form-control:focus {
                border-color: #6366f1;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            }

            .auth-form-area .form-label {
                font-size: 0.85rem;
                font-weight: 600;
                color: #495057;
                margin-bottom: 0.4rem;
            }

            .btn-auth {
                background: #212529;
                border: 0;
                border-radius: 0.625rem;
                padding: 0.7rem 1rem;
                font-size: 0.9rem;
                font-weight: 600;
                letter-spacing: 0.02em;
                color: #fff;
                transition: background 0.15s ease, transform 0.1s ease;
            }

            .btn-auth:hover {
                background: #343a40;
                color: #fff;
                transform: translateY(-1px);
            }

            .btn-auth:active {
                transform: translateY(0);
            }
        </style>
    </head>
    <body class="auth-admin">
        <div class="auth-shell">
            <div class="auth-card">

                <div class="auth-logo-area">
                    <div class="auth-logo-wrap">
                        @if ($adminSettings && $adminSettings->company_logo_path)
                            <img src="{{ asset('storage/' . $adminSettings->company_logo_path) }}" alt="{{ $adminSettings->company_name ?? 'Logo' }}">
                        @else
                            <div class="auth-logo-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        @endif
                    </div>
                    <div class="auth-org-name">{{ $adminSettings->company_name ?? 'EYWEP-CDJS' }}</div>
                    <div class="auth-tagline">Espace d'administration</div>
                </div>

                <div class="auth-form-area">
                    @if (session('status'))
                        <div class="alert alert-success mb-3">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="exemple@domaine.com"
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label for="remember_me" class="form-check-label" style="font-size: 0.85rem;">Se souvenir de moi</label>
                            </div>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="small text-decoration-none" style="font-size: 0.85rem; color: #6366f1;">
                                    Mot de passe oublie ?
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-auth w-100">
                            Se connecter
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </body>
</html>
