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
            --color-secondary-button-icon-background: {{ $settings->primary_color ?: '#1c2539' }};
            --color-secondary-button-hover-text: rgba(255, 255, 255, 1);
            --color-secondary-button-hover-background: {{ $settings->primary_color ?: '#1c2539' }};
            --color-secondary-button-hover-border: {{ $settings->primary_color ?: '#1c2539' }};
            --color-secondary-button-hover-icon: {{ $settings->primary_color ?: '#1c2539' }};
            --color-secondary-button-hover-icon-background: rgba(255, 255, 255, 1);
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

        /* Espacement inter-sections réduit */
        .mt-100 { margin-top: 0; }

        /* Navbar sticky — couleur primaire */
        .header-1.header-floating:hover,
        .header-1.header-sticky.scrolled-past-header {
            --color-background: {{ $settings->primary_color ?: '#1c2539' }} !important;
        }

        /* Footer — couleur primaire */
        .footer-main {
            --color-background: {{ $settings->primary_color ?: '#1c2539' }};
        }
        .footer-bottom {
            --color-background: {{ $settings->primary_color ?: '#1c2539' }};
            background-color: {{ $settings->primary_color ?: '#1c2539' }} !important;
        }
        footer .social-link {
            background-color: {{ $settings->primary_color ?: '#1c2539' }};
        }

        /* Navbar — même police et graisse que index.html */
        .menu-link {
            font-family: var(--font-heading--family);
            font-weight: 500;
            font-size: var(--font-nav-main);
            letter-spacing: .01em;
        }

        .eywep-topbar {
            background: linear-gradient(90deg, {{ $settings->primary_color ?: '#1c2539' }} 0%, #101728 100%);
        }

        .eywep-dynamic-logo {
            max-height: 52px;
            width: auto;
        }

        .eywep-brand-name {
            font-family: var(--font-heading--family);
            font-weight: 700;
            font-size: 22px;
            color: #fff;
            letter-spacing: .02em;
            line-height: 1;
        }

        .header-1:not(.is-sticky) .eywep-brand-name { color: #fff; }
        .header-1.is-sticky .eywep-brand-name { color: var(--color-foreground-heading); }

    </style>

    <link rel="stylesheet" href="{{ asset('front-assets/consulo/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/consulo/css/style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    @include('front.partials.header')

    @yield('content')

    @include('front.partials.footer')
    @stack('scripts')
</body>
</html>
