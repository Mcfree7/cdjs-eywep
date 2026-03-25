<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="view-transition" content="same-origin">
    <meta
        name="description"
        content="@yield('description', $settings->company_slogan ?? 'Programme EYWEP et contenus publics.')"
    >
    <title>@yield('title', ($settings->company_name ?? 'EYWEP') . ' - Programme d\'entrepreneuriat')</title>

    <link rel="shortcut icon" href="{{ asset('front-assets/consulo/img/favicon.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"
    >

    <style>
        :root {
            --font-body--family: "Inter", sans-serif;
            --font-body--style: normal;
            --font-body--weight: 400;
            --font-heading--family: "Poppins", sans-serif;
            --font-heading--style: normal;
            --font-heading--weight: 600;
            --font-button--family: "Poppins", sans-serif;
            --font-button--style: normal;
            --font-button--weight: 600;
            --font-h1--size: 60px;
            --font-h2--size: 48px;
            --font-h3--size: 36px;
            --font-h4--size: 24px;
            --font-h5--size: 20px;
            --font-h6--size: 16px;
            --font-nav-main: 16px;
            --color-background: rgba(255, 255, 255, 1);
            --color-foreground: rgba(28, 37, 57, 1);
            --color-foreground-heading: rgba(28, 37, 57, 1);
            --color-foreground-subheading: rgba(93, 102, 111, 1);
            --color-background-subheading: rgba(255, 255, 255, 0.1);
            --color-border-subheading-bg: rgba(32, 40, 45, 0.1);
            --color-primary: {{ $settings->primary_color ?: '#1c2539' }};
            --color-primary-background: {{ $settings->primary_color ?: '#1c2539' }};
            --color-primary-hover: {{ $settings->primary_color ?: '#1c2539' }};
            --color-primary-background-hover: {{ $settings->primary_color ?: '#1c2539' }};
            --color-border: rgba(255, 255, 255, 0.3);
            --color-border-hover: rgba(93, 102, 111, 0.5);
            --color-shadow: rgba(0, 0, 0, 1);
            --color-overlay: rgba(28, 37, 57, 0.6);
            --color-primary-button-text: rgba(255, 255, 255, 1);
            --color-primary-button-background: {{ $settings->primary_color ?: '#20282d' }};
            --color-primary-button-border: {{ $settings->primary_color ?: '#20282d' }};
            --color-primary-button-icon: rgba(28, 37, 57, 1);
            --color-primary-button-icon-background: rgba(255, 255, 255, 1);
            --color-primary-button-hover-text: rgba(32, 40, 45, 1);
            --color-primary-button-hover-background: rgba(255, 255, 255, 1);
            --color-primary-button-hover-border: {{ $settings->primary_color ?: '#20282d' }};
            --color-primary-button-hover-icon: rgba(255, 255, 255, 1);
            --color-primary-button-hover-icon-background: {{ $settings->primary_color ?: '#1c2539' }};
            --color-secondary-button-text: rgba(32, 40, 45, 1);
            --color-secondary-button-background: rgba(255, 255, 255, 1);
            --color-secondary-button-border: rgba(255, 255, 255, 1);
            --color-secondary-button-icon: rgba(255, 255, 255, 1);
            --color-secondary-button-icon-background: rgba(32, 40, 45, 1);
            --color-secondary-button-hover-text: rgba(255, 255, 255, 1);
            --color-secondary-button-hover-background: rgba(32, 40, 45, 1);
            --color-secondary-button-hover-border: rgba(32, 40, 45, 1);
            --color-secondary-button-hover-icon: rgba(28, 37, 57, 1);
            --color-secondary-button-icon-background: rgba(255, 255, 255, 1);
            --style-border-width-buttons-primary: 1px;
            --style-border-width-buttons-secondary: 1px;
            --style-border-radius-buttons-primary: 40px;
            --style-border-radius-buttons-secondary: 40px;
        }

        @media (max-width: 767px) {
            :root {
                --font-h1--size: 42px;
                --font-h2--size: 34px;
                --font-h3--size: 28px;
                --font-h4--size: 22px;
                --font-h5--size: 18px;
            }
        }

        .eywep-topbar {
            background: linear-gradient(90deg, {{ $settings->primary_color ?: '#1c2539' }} 0%, #101728 100%);
        }

        .eywep-dynamic-logo {
            max-height: 36px;
            width: auto;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('front-assets/consulo/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/consulo/css/style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="eywep-topbar py-2">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 text-white">
                <div class="text text-16 text-white">
                    {{ $settings->company_slogan ?? 'Programme de promotion de l’entrepreneuriat EYWEP' }}
                </div>
                <div class="d-flex flex-wrap gap-3 text text-16 text-white">
                    @if ($settings->company_phone)
                        <a href="tel:{{ $settings->company_phone }}" class="text-white">{{ $settings->company_phone }}</a>
                    @endif
                    @if ($settings->company_email)
                        <a href="mailto:{{ $settings->company_email }}" class="text-white">{{ $settings->company_email }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <sticky-header data-sticky-type="always">
        <header class="header-1">
            <div class="container-fluid">
                <div class="header-grid">
                    <a class="header-logo" href="{{ route('front.home') }}" aria-label="{{ $settings->company_name ?? 'EYWEP' }}">
                        @if ($settings->company_logo_path)
                            <img
                                src="{{ Storage::url($settings->company_logo_path) }}"
                                alt="{{ $settings->company_name }}"
                                class="eywep-dynamic-logo"
                            >
                        @else
                            <img
                                src="{{ asset('front-assets/consulo/img/logo.png') }}"
                                alt="{{ $settings->company_name ?? 'EYWEP' }}"
                                width="189"
                                height="32"
                            >
                        @endif
                    </a>

                    <drawer-menu>
                        <nav class="header-nav drawer-menu">
                            <div class="d-lg-none header-nav-headings">
                                <a class="header-logo" href="{{ route('front.home') }}" aria-label="{{ $settings->company_name ?? 'EYWEP' }}">
                                    @if ($settings->company_logo_path)
                                        <img
                                            src="{{ Storage::url($settings->company_logo_path) }}"
                                            alt="{{ $settings->company_name }}"
                                            class="eywep-dynamic-logo"
                                        >
                                    @else
                                        <img
                                            src="{{ asset('front-assets/consulo/img/logo.png') }}"
                                            alt="{{ $settings->company_name ?? 'EYWEP' }}"
                                            width="189"
                                            height="32"
                                        >
                                    @endif
                                </a>
                                <drawer-opener class="svg-wrapper menu-close" data-drawer=".drawer-menu">
                                    <span class="text text-16">Fermer</span>
                                </drawer-opener>
                            </div>

                            <ul class="header-menu list-unstyled">
                                <li><a href="{{ route('front.home') }}" class="menu-link">Accueil</a></li>
                                <li><a href="{{ route('front.articles.index') }}" class="menu-link">Articles</a></li>
                                <li><a href="{{ route('front.activities.index') }}" class="menu-link">Activites</a></li>
                                <li><a href="{{ route('front.success-stories.index') }}" class="menu-link">Temoignages</a></li>
                                <li><a href="{{ route('front.galleries.index') }}" class="menu-link">Galeries</a></li>
                                <li><a href="{{ route('front.resources.index') }}" class="menu-link">Ressources</a></li>
                            </ul>
                        </nav>
                    </drawer-menu>

                    <div class="header-actions d-flex align-items-center">
                        <a href="#contact" class="button button--primary" aria-label="Nous contacter">
                            Nous contacter
                        </a>
                        <drawer-opener class="header-sidebar svg-wrapper d-lg-none ms-3" data-drawer=".drawer-menu">
                            <span class="text text-16">Menu</span>
                        </drawer-opener>
                    </div>
                </div>
            </div>
        </header>
    </sticky-header>

    @yield('content')

    <footer class="footer-1 bg-primary-foreground overflow-hidden" id="contact">
        <div class="footer-background">
            <img
                src="{{ asset('front-assets/consulo/img/footer/footer-map.png') }}"
                alt="Footer background"
                loading="lazy"
            >
        </div>
        <div class="container">
            <div class="footer-top section-padding">
                <div class="row g-4">
                    <div class="col-12 col-lg-5">
                        <div class="footer-widget">
                            <div class="widget-heading heading text-22 text-white">
                                {{ $settings->company_name ?? 'EYWEP' }}
                            </div>
                            <p class="text text-18 text-white mt-3">
                                {{ $settings->hero_subtitle ?? $settings->company_slogan ?? 'Programme de promotion de l’entrepreneuriat avec contenus publics, activites et ressources.' }}
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="footer-widget footer-widget-menu">
                            <div class="widget-heading heading text-22 text-white">Navigation</div>
                            <ul class="footer-menu list-unstyled">
                                <li><a href="{{ route('front.articles.index') }}" class="text text-16 link text-white">Articles</a></li>
                                <li><a href="{{ route('front.activities.index') }}" class="text text-16 link text-white">Activites</a></li>
                                <li><a href="{{ route('front.success-stories.index') }}" class="text text-16 link text-white">Temoignages</a></li>
                                <li><a href="{{ route('front.galleries.index') }}" class="text text-16 link text-white">Galeries</a></li>
                                <li><a href="{{ route('front.resources.index') }}" class="text text-16 link text-white">Ressources</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="footer-widget footer-widget-menu">
                            <div class="widget-heading heading text-22 text-white">Contact</div>
                            <ul class="footer-menu list-unstyled">
                                @if ($settings->company_address)
                                    <li><span class="text text-16 text-white">{{ $settings->company_address }}</span></li>
                                @endif
                                @if ($settings->company_phone)
                                    <li><a href="tel:{{ $settings->company_phone }}" class="text text-16 link text-white">{{ $settings->company_phone }}</a></li>
                                @endif
                                @if ($settings->company_email)
                                    <li><a href="mailto:{{ $settings->company_email }}" class="text text-16 link text-white">{{ $settings->company_email }}</a></li>
                                @endif
                                @if ($settings->company_location)
                                    <li><a href="{{ $settings->company_location }}" target="_blank" rel="noreferrer" class="text text-16 link text-white">Voir la localisation</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row footer-bottom-row">
                    <div class="col-12 col-md-6">
                        <div class="footer-copyright text text-16 text-white">
                            Copyright &copy;<span class="current-year"></span> {{ $settings->company_name ?? 'EYWEP' }}.
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <ul class="footer-menu footer-policies list-unstyled">
                            <li><a href="{{ route('front.home') }}" class="text text-16 link text-white">Accueil</a></li>
                            <li><a href="{{ route('front.resources.index') }}" class="text text-16 link text-white">Ressources</a></li>
                            <li><a href="#contact" class="text text-16 link text-white">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <drawer-opener id="drawer-overlay"></drawer-opener>

    <scroll-top>
        <div class="scroll-to-top">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5"/>
            </svg>
        </div>
    </scroll-top>

    <script src="{{ asset('front-assets/consulo/js/vendor.js') }}" defer></script>
    <script src="{{ asset('front-assets/consulo/js/main.js') }}" defer></script>
</body>
</html>
