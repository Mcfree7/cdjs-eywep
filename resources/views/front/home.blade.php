@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp
@extends('front.layouts.app')

@section('title', ($settings->company_name ?? 'EYWEP') . ' - Accueil')
@section('description', $settings->company_slogan ?? 'Programme de promotion de l\'entrepreneuriat EYWEP')

@section('content')
<main>

    {{-- ========================================================
         HERO SLIDER
    ======================================================== --}}
    @php
        $heroImages = $settings->hero_images ?? [];
        $useAsset   = empty($heroImages);
        if ($useAsset) {
            $heroImages = [
                ['src' => 'front-assets/consulo/img/slider/hero-1.jpg',  'src575' => 'front-assets/consulo/img/slider/hero-575.jpg',  'src991' => 'front-assets/consulo/img/slider/hero-991.jpg'],
                ['src' => 'front-assets/consulo/img/slider/hero-2.jpg',  'src575' => 'front-assets/consulo/img/slider/hero2-575.jpg', 'src991' => 'front-assets/consulo/img/slider/hero2-991.jpg'],
            ];
        }
    @endphp

    <hero-slider class="hero-slider with-floating-header">
        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach ($heroImages as $index => $heroImage)
                <div class="swiper-slide">
                    <div class="slider-card overlay">
                        <picture class="slider-media">
                            @if ($useAsset)
                                <source media="(max-width: 575px)"  srcset="{{ asset($heroImage['src575']) }}">
                                <source media="(max-width: 991px)"  srcset="{{ asset($heroImage['src991']) }}">
                                <img src="{{ asset($heroImage['src']) }}" width="1920" height="1000" {{ $index === 0 ? 'loading=eager' : 'loading=lazy' }} alt="Hero Image">
                            @else
                                <img src="{{ Storage::url($heroImage) }}" width="1920" height="1000" {{ $index === 0 ? 'loading=eager' : 'loading=lazy' }} alt="Hero Image">
                            @endif
                        </picture>
                        <div class="slider-content">
                            <div class="container height-100 d-flex align-items-center">
                                <div class="content-box slider-animation section-headings">
                                    <div class="subheading text-20 subheading-bg">
                                        <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <g clip-path="url(#clip-hero-{{ $index }})">
                                                <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="CurrentColor"/>
                                            </g>
                                            <defs><clipPath id="clip-hero-{{ $index }}"><rect width="14" height="14" fill="CurrentColor"/></clipPath></defs>
                                        </svg>
                                        <span>{{ $settings->company_name ?? 'EYWEP' }}</span>
                                        <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <g clip-path="url(#clip-hero-b-{{ $index }})">
                                                <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="CurrentColor"/>
                                            </g>
                                            <defs><clipPath id="clip-hero-b-{{ $index }}"><rect width="14" height="14" fill="CurrentColor"/></clipPath></defs>
                                        </svg>
                                    </div>
                                    <h2 class="heading text-90 fw-700">
                                        {{ $settings->hero_title ?? 'Entrepreneuriat &amp; Innovation' }}
                                    </h2>
                                    <div class="text text-18">
                                        {{ $settings->hero_subtitle ?? 'Programme de promotion de l\'entrepreneuriat jeune — articles, activités, ressources et projets.' }}
                                    </div>
                                    <div class="buttons">
                                        <a href="{{ route('front.projects.index') }}" class="button button--secondary" aria-label="Nos Projets">
                                            Nos Projets
                                            <span class="svg-wrapper">
                                                <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </a>
                                        <a href="{{ route('front.contact') }}" class="button button--secondary" aria-label="Nous contacter">
                                            Nous contacter
                                            <span class="svg-wrapper">
                                                <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Slider nav --}}
            <div class="slider-nav">
                <div class="swiper-button-prev">
                    <svg class="icon icon-32" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M14.6663 25.3359L5.33301 16.0026M5.33301 16.0026L14.6663 6.66927M5.33301 16.0026H26.6663" stroke="CurrentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="swiper-button-next">
                    <svg class="icon icon-32" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M17.3337 25.3359L26.667 16.0026M26.667 16.0026L17.3337 6.66927M26.667 16.0026H5.33366" stroke="CurrentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </hero-slider>

    {{-- ========================================================
         ABOUT US
    ======================================================== --}}
    @php
        // ── Textes modifiables directement ici ──────────────────────────────
        $aboutSubheading = 'À propos';
        $aboutTitle      = 'Qui sommes-nous ?';
        $aboutLead       = 'EYWEP (Entrepreneurship & Youth Work Empowerment Program) est un programme dédié à la promotion de l\'entrepreneuriat jeune en Afrique centrale.';
        $aboutBody       = 'Depuis notre création, nous accompagnons des centaines de jeunes entrepreneurs à travers des formations, des ateliers pratiques, des financements seed et un réseau de mentors expérimentés. Notre mission est de transformer les idées en projets viables et de créer un écosystème entrepreneurial fort et durable.';
        $aboutStat1      = ['value' => '500+', 'label' => 'Jeunes accompagnés'];
        $aboutStat2      = ['value' => '120+', 'label' => 'Projets financés'];
        $aboutStat3      = ['value' => '15',   'label' => 'Pays couverts'];
        $aboutBullets    = [
            'Formation pratique et accompagnement personnalisé pour chaque entrepreneur.',
            'Accès à un réseau de mentors expérimentés et de partenaires stratégiques.',
            'Financement seed et ressources pour concrétiser les idées innovantes.',
            'Présence dans 15 pays avec un réseau actif de plus de 500 jeunes.',
        ];
        // Image : première image du carousel hero (modifiable ici)
        $heroImgs   = $settings->hero_images ?? [];
        $aboutImage = !empty($heroImgs)
            ? Storage::url($heroImgs[0])
            : asset('front-assets/consulo/img/slider/hero-1.jpg');
        // ────────────────────────────────────────────────────────────────────
    @endphp
    <section id="about-us" class="section-about mt-100 section-padding" style="background:#fff;">
        <div class="container">
            <div class="row align-items-center g-5">

                {{-- Colonne image --}}
                <div class="col-lg-6">
                    <div class="about-images position-relative">
                        <img
                            src="{{ $aboutImage }}"
                            alt="À propos EYWEP"
                            loading="lazy"
                            class="radius18 w-100"
                            style="max-height:500px; object-fit:cover;"
                        >
                        {{-- Stats flottantes --}}
                        <div class="d-flex gap-3 flex-wrap" style="position:absolute; bottom:-20px; left:20px;">
                            @foreach ([$aboutStat1, $aboutStat2, $aboutStat3] as $stat)
                            <div class="radius18 text-center px-3 py-2" style="background:#fff; box-shadow:0 4px 20px rgba(0,0,0,.12); min-width:90px;">
                                <div class="fw-700 text-22" style="color:var(--color-primary);">{{ $stat['value'] }}</div>
                                <div style="font-size:12px; color:var(--color-foreground-subheading);">{{ $stat['label'] }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Colonne texte --}}
                <div class="col-lg-6 pt-5 pt-lg-0">
                    <div class="section-headings mb-4">
                        <div class="subheading text-20 subheading-bg">
                            <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="currentColor"/>
                            </svg>
                            {{ $aboutSubheading }}
                        </div>
                        <h2 class="heading text-50 fw-700">{{ $aboutTitle }}</h2>
                    </div>

                    <p class="text text-18 mb-3 fw-500">{{ $aboutLead }}</p>
                    <p class="text text-16 mb-4" style="color:var(--color-foreground-subheading);">{{ $aboutBody }}</p>

                    {{-- Puces --}}
                    <ul class="list-unstyled mb-4" style="display:flex; flex-direction:column; gap:12px;">
                        @foreach ($aboutBullets as $bullet)
                        <li class="d-flex align-items-start gap-2">
                            <svg style="flex-shrink:0; margin-top:2px; width:22px; height:22px; color:var(--color-primary);" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <defs><clipPath id="chk-home-{{ $loop->index }}"><rect width="28" height="28" fill="white"/></clipPath></defs>
                                <g clip-path="url(#chk-home-{{ $loop->index }})">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.81362 13.0268C8.34112 12.7113 7.70994 12.783 7.31911 13.196C6.92886 13.6084 6.89211 14.2431 7.23336 14.6975L10.7334 19.3642C10.9445 19.6453 11.2712 19.8168 11.6229 19.8303C11.9741 19.8431 12.313 19.6972 12.5446 19.4324L20.7113 10.0991C21.1144 9.63883 21.0928 8.94525 20.6623 8.51008C20.2318 8.07492 19.5388 8.04692 19.0739 8.44475L11.5786 14.8696L8.81362 13.0268Z" fill="white"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9327 0.515625C6.52939 0.515625 0.519531 6.52549 0.519531 13.9288C0.519531 21.3321 6.52939 27.3419 13.9327 27.3419C21.336 27.3419 27.3458 21.3321 27.3458 13.9288C27.3458 6.52549 21.336 0.515625 13.9327 0.515625ZM13.9327 1.68166C20.6921 1.68166 26.1798 7.16938 26.1798 13.9288C26.1798 20.6882 20.6921 26.1759 13.9327 26.1759C7.17329 26.1759 1.68557 20.6882 1.68557 13.9288C1.68557 7.16938 7.17329 1.68166 13.9327 1.68166Z" fill="currentColor"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13872 12.5389C8.42939 12.0658 7.48265 12.1731 6.89698 12.792C6.31073 13.4115 6.25648 14.363 6.76806 15.0449L10.2681 19.7115C10.5848 20.1339 11.0748 20.3905 11.6021 20.4104C12.1295 20.4302 12.6376 20.2109 12.9852 19.8142L21.1519 10.4809C21.7562 9.78965 21.7241 8.74956 21.0784 8.0974C20.4326 7.44465 19.3926 7.40205 18.6961 7.99938L11.5356 14.1366L9.13872 12.5389ZM8.4918 13.5096L11.2562 15.3529C11.4738 15.4976 11.7608 15.4801 11.9597 15.3103L19.455 8.88547C19.6871 8.68597 20.0342 8.70055 20.2495 8.91814C20.4647 9.13514 20.4752 9.48222 20.274 9.71264L12.1073 19.046C11.9912 19.1778 11.8221 19.2513 11.6459 19.2443C11.4703 19.2379 11.307 19.1521 11.2014 19.0116L7.7014 14.3449C7.53106 14.1174 7.54913 13.8006 7.74455 13.5941C7.93938 13.3876 8.25497 13.3521 8.4918 13.5096Z" fill="currentColor"/>
                                </g>
                            </svg>
                            <span class="text text-16">{{ $bullet }}</span>
                        </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('front.about') }}" class="button button--primary">
                        En savoir plus
                        <span class="svg-wrapper">
                            <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                            </svg>
                        </span>
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- ========================================================
         SPONSORS (défilement infini — données backoffice)
    ======================================================== --}}
    @if ($partners->isNotEmpty())
    @php
        // Dupliquer la liste pour le scroll infini CSS
        $sponsorList = $partners->all();
    @endphp
    <section class="section-sponsors py-5" style="background:#fff; overflow:hidden;">
        <div class="container mb-4">
            <div class="section-headings text-center">
                <div class="subheading text-20 subheading-bg d-inline-flex">
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="currentColor"/>
                    </svg>
                    Ils nous font confiance
                </div>
            </div>
        </div>

        {{-- Défilement CSS infini (aucun JS requis) --}}
        <div class="sponsors-track-wrapper" style="position:relative;">
            <div style="pointer-events:none;position:absolute;top:0;left:0;width:120px;height:100%;background:linear-gradient(to right,#fff,transparent);z-index:2;"></div>
            <div style="pointer-events:none;position:absolute;top:0;right:0;width:120px;height:100%;background:linear-gradient(to left,#fff,transparent);z-index:2;"></div>

            <div class="sponsors-track d-flex align-items-center gap-5" style="width:max-content; animation:sponsors-scroll 30s linear infinite;">
                @foreach (array_merge($sponsorList, $sponsorList) as $partner)
                <div class="flex-shrink-0 text-center px-3">
                    @if ($partner->logo_path)
                        <img
                            src="{{ Storage::url($partner->logo_path) }}"
                            alt="{{ $partner->titre }}"
                            loading="lazy"
                            style="max-height:70px; max-width:160px; object-fit:contain; filter:grayscale(60%); opacity:.8; transition:filter .3s,opacity .3s;"
                            onmouseover="this.style.filter='grayscale(0)';this.style.opacity='1';"
                            onmouseout="this.style.filter='grayscale(60%)';this.style.opacity='.8';"
                        >
                    @else
                        <span class="fw-600 text-16" style="color:var(--color-foreground-subheading); white-space:nowrap;">{{ $partner->titre }}</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <style>
            @keyframes sponsors-scroll {
                from { transform: translateX(0); }
                to   { transform: translateX(-50%); }
            }
            @media (prefers-reduced-motion: reduce) {
                .sponsors-track { animation: none !important; }
            }
        </style>
    </section>
    @endif

    {{-- ========================================================
         LATEST ARTICLES
    ======================================================== --}}
    @if ($articles->isNotEmpty())
    <section class="page-blog mt-100 section-padding">
        <div class="container">
            <div class="section-headings text-center mb-60">
                <div class="subheading text-20 subheading-bg">
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="currentColor"/>
                    </svg>
                    Actualités
                </div>
                <h2 class="heading text-50 fw-700">Derniers Articles</h2>
            </div>
            <div class="product-grid">
                @foreach ($articles as $article)
                <div class="card-blog radius18">
                    <div class="card-blog-content">
                        <div class="card-blog-meta d-flex align-items-center gap-2 mb-3">
                            <span class="text text-14 text-muted">
                                {{ $article->datePublication ? $article->datePublication->format('d/m/Y') : '' }}
                            </span>
                        </div>
                        <h3 class="heading text-22 fw-700 mb-3">
                            <a href="{{ route('front.articles.show', $article) }}" class="link">
                                {{ $article->titre }}
                            </a>
                        </h3>
                        <p class="text text-18 mb-4">
                            {{ Str::limit(strip_tags($article->description), 150) }}
                        </p>
                        <a href="{{ route('front.articles.show', $article) }}" class="button button--primary">
                            Lire la suite
                            <svg viewBox="0 0 11 10" fill="none" style="width:11px;height:10px;display:inline-block;margin-left:6px;">
                                <path d="M2.167 0.833C2.167 0.612 2.254 0.400 2.411 0.244C2.567 0.088 2.779 0 3.000 0H9.667C9.888 0 10.100 0.088 10.256 0.244C10.412 0.400 10.500 0.612 10.500 0.833V7.500C10.500 7.721 10.412 7.933 10.256 8.089C10.100 8.246 9.888 8.333 9.667 8.333C9.446 8.333 9.234 8.246 9.077 8.089C8.921 7.933 8.833 7.721 8.833 7.500V2.845L1.923 9.756C1.765 9.908 1.555 9.992 1.336 9.990C1.118 9.988 0.909 9.900 0.754 9.746C0.600 9.591 0.512 9.382 0.510 9.164C0.508 8.945 0.592 8.735 0.744 8.578L7.655 1.667H3.000C2.779 1.667 2.567 1.579 2.411 1.423C2.254 1.266 2.167 1.054 2.167 0.833Z" fill="currentColor"/>
                            </svg>
                        </a>
                    </div>
                    <div class="card-blog-img radius18">
                        <a href="{{ route('front.articles.show', $article) }}">
                            <img
                                src="{{ $article->coverImage ? Storage::url($article->coverImage->image_path) : asset('front-assets/consulo/img/blog/1.jpg') }}"
                                alt="{{ $article->titre }}"
                                loading="lazy"
                                class="radius18"
                            >
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('front.articles.index') }}" class="button button--secondary">
                    Voir tous les articles
                    <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ========================================================
         LATEST ACTIVITIES
    ======================================================== --}}
    @if ($activities->isNotEmpty())
    <section class="page-blog mt-100 section-padding" style="background-color: var(--color-background, #f8f9fa);">
        <div class="container">
            <div class="section-headings text-center mb-60">
                <div class="subheading text-20 subheading-bg">
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="currentColor"/>
                    </svg>
                    Activités
                </div>
                <h2 class="heading text-50 fw-700">Nos Dernières Activités</h2>
            </div>
            <div class="product-grid">
                @foreach ($activities as $activity)
                <div class="card-blog radius18">
                    <div class="card-blog-content">
                        <div class="card-blog-meta d-flex align-items-center gap-2 mb-3">
                            <span class="text text-14 text-muted">
                                {{ $activity->datePublication ? $activity->datePublication->format('d/m/Y') : '' }}
                            </span>
                        </div>
                        <h3 class="heading text-22 fw-700 mb-3">
                            <a href="{{ route('front.activities.show', $activity) }}" class="link">
                                {{ $activity->titre }}
                            </a>
                        </h3>
                        <p class="text text-18 mb-4">
                            {{ Str::limit(strip_tags($activity->description), 150) }}
                        </p>
                        <a href="{{ route('front.activities.show', $activity) }}" class="button button--primary">
                            Lire la suite
                            <svg viewBox="0 0 11 10" fill="none" style="width:11px;height:10px;display:inline-block;margin-left:6px;">
                                <path d="M2.167 0.833C2.167 0.612 2.254 0.400 2.411 0.244C2.567 0.088 2.779 0 3.000 0H9.667C9.888 0 10.100 0.088 10.256 0.244C10.412 0.400 10.500 0.612 10.500 0.833V7.500C10.500 7.721 10.412 7.933 10.256 8.089C10.100 8.246 9.888 8.333 9.667 8.333C9.446 8.333 9.234 8.246 9.077 8.089C8.921 7.933 8.833 7.721 8.833 7.500V2.845L1.923 9.756C1.765 9.908 1.555 9.992 1.336 9.990C1.118 9.988 0.909 9.900 0.754 9.746C0.600 9.591 0.512 9.382 0.510 9.164C0.508 8.945 0.592 8.735 0.744 8.578L7.655 1.667H3.000C2.779 1.667 2.567 1.579 2.411 1.423C2.254 1.266 2.167 1.054 2.167 0.833Z" fill="currentColor"/>
                            </svg>
                        </a>
                    </div>
                    <div class="card-blog-img radius18">
                        <a href="{{ route('front.activities.show', $activity) }}">
                            <img
                                src="{{ $activity->coverImage ? Storage::url($activity->coverImage->image_path) : asset('front-assets/consulo/img/blog/1.jpg') }}"
                                alt="{{ $activity->titre }}"
                                loading="lazy"
                                class="radius18"
                            >
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('front.activities.index') }}" class="button button--secondary">
                    Voir toutes les activités
                    <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ========================================================
         FEATURED PROJECTS
    ======================================================== --}}
    @if (isset($projects) && $projects->isNotEmpty())
    <section class="page-projects mt-100 section-padding">
        <div class="container">
            <div class="section-headings text-center mb-60">
                <div class="subheading text-20 subheading-bg">
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="currentColor"/>
                    </svg>
                    Projets
                </div>
                <h2 class="heading text-50 fw-700">Nos Projets</h2>
            </div>
            <div class="product-grid">
                @foreach ($projects as $project)
                <div class="card-project radius18">
                    <div class="card-project-img radius18">
                        <img
                            src="{{ $project->coverImage ? Storage::url($project->coverImage->image_path) : asset('front-assets/consulo/img/project/card/1.jpg') }}"
                            alt="{{ $project->titre }}"
                            loading="lazy"
                            class="radius18"
                        >
                    </div>
                    <div class="card-project-overlay radius18">
                        <div class="card-project-content">
                            <span class="badge {{ $project->statut === 'ouvert' ? 'bg-success' : ($project->statut === 'ferme' ? 'bg-danger' : 'bg-secondary') }} mb-2">
                                {{ ucfirst($project->statut) }}
                            </span>
                            <h3 class="heading text-22 fw-700 text-white mb-2">
                                {{ $project->titre }}
                            </h3>
                        </div>
                        <a href="{{ route('front.projects.show', $project) }}" class="card-project-link" aria-label="Voir {{ $project->titre }}">
                            <svg viewBox="0 0 64 64" fill="none" style="width:48px;height:48px;">
                                <circle cx="32" cy="32" r="32" fill="white"/>
                                <path d="M26.167 39C25.817 39 25.583 38.883 25.350 38.650C24.883 38.183 24.883 37.483 25.350 37.017L37.017 25.350C37.483 24.883 38.183 24.883 38.650 25.350C39.117 25.817 39.117 26.517 38.650 26.983L26.983 38.650C26.750 38.883 26.517 39 26.167 39Z" fill="#20282D"/>
                                <path d="M37.833 37.833C37.133 37.833 36.667 37.367 36.667 36.667V27.333H27.333C26.633 27.333 26.167 26.867 26.167 26.167C26.167 25.467 26.633 25 27.333 25H37.833C38.533 25 39.000 25.467 39.000 26.167V36.667C39.000 37.367 38.533 37.833 37.833 37.833Z" fill="#20282D"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('front.projects.index') }}" class="button button--secondary">
                    Voir tous les projets
                    <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ========================================================
         SUCCESS STORIES
    ======================================================== --}}
    @if ($successStories->isNotEmpty())
    <section class="mt-100 section-padding" style="background-color: var(--color-background, #f8f9fa);">
        <div class="container">
            <div class="section-headings text-center mb-60">
                <div class="subheading text-20 subheading-bg">
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="currentColor"/>
                    </svg>
                    Témoignages
                </div>
                <h2 class="heading text-50 fw-700">Histoires de Succès</h2>
            </div>
            <div class="product-grid">
                @foreach ($successStories as $story)
                <div class="card-blog radius18">
                    <div class="card-blog-content">
                        <div class="card-blog-meta d-flex align-items-center gap-2 mb-3">
                            <span class="text text-14 text-muted">
                                {{ $story->datePublication ? $story->datePublication->format('d/m/Y') : '' }}
                            </span>
                        </div>
                        <h3 class="heading text-22 fw-700 mb-3">
                            <a href="{{ route('front.success-stories.show', $story) }}" class="link">
                                {{ $story->titre }}
                            </a>
                        </h3>
                        <p class="text text-18 mb-4">
                            {{ Str::limit(strip_tags($story->description), 150) }}
                        </p>
                        <a href="{{ route('front.success-stories.show', $story) }}" class="button button--primary">
                            Lire la suite
                            <svg viewBox="0 0 11 10" fill="none" style="width:11px;height:10px;display:inline-block;margin-left:6px;">
                                <path d="M2.167 0.833C2.167 0.612 2.254 0.400 2.411 0.244C2.567 0.088 2.779 0 3.000 0H9.667C9.888 0 10.100 0.088 10.256 0.244C10.412 0.400 10.500 0.612 10.500 0.833V7.500C10.500 7.721 10.412 7.933 10.256 8.089C10.100 8.246 9.888 8.333 9.667 8.333C9.446 8.333 9.234 8.246 9.077 8.089C8.921 7.933 8.833 7.721 8.833 7.500V2.845L1.923 9.756C1.765 9.908 1.555 9.992 1.336 9.990C1.118 9.988 0.909 9.900 0.754 9.746C0.600 9.591 0.512 9.382 0.510 9.164C0.508 8.945 0.592 8.735 0.744 8.578L7.655 1.667H3.000C2.779 1.667 2.567 1.579 2.411 1.423C2.254 1.266 2.167 1.054 2.167 0.833Z" fill="currentColor"/>
                            </svg>
                        </a>
                    </div>
                    <div class="card-blog-img radius18">
                        <a href="{{ route('front.success-stories.show', $story) }}">
                            <img
                                src="{{ $story->coverImage ? Storage::url($story->coverImage->image_path) : asset('front-assets/consulo/img/blog/1.jpg') }}"
                                alt="{{ $story->titre }}"
                                loading="lazy"
                                class="radius18"
                            >
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('front.success-stories.index') }}" class="button button--secondary">
                    Voir tous les témoignages
                    <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ========================================================
         RESOURCES
    ======================================================== --}}
    @if ($resources->isNotEmpty())
    <section class="mt-100 section-padding">
        <div class="container">
            <div class="section-headings text-center mb-60">
                <div class="subheading text-20 subheading-bg">
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="currentColor"/>
                    </svg>
                    Documents
                </div>
                <h2 class="heading text-50 fw-700">Ressources disponibles</h2>
            </div>
            <div class="row g-4">
                @foreach ($resources as $resource)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="radius18 p-4 h-100 d-flex flex-column" style="border: 1px solid rgba(0,0,0,0.08); background:#fff;">
                        <div class="mb-3">
                            <span class="text text-14 text-muted">
                                {{ $resource->datePublication ? $resource->datePublication->format('d/m/Y') : '' }}
                            </span>
                        </div>
                        <h3 class="heading text-20 fw-700 mb-3">{{ $resource->titre }}</h3>
                        <p class="text text-18 flex-grow-1 mb-4">
                            {{ Str::limit(strip_tags($resource->description), 100) }}
                        </p>
                        <a href="{{ route('front.resources.download', $resource) }}" class="button button--primary">
                            Télécharger
                            <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('front.resources.index') }}" class="button button--secondary">
                    Voir toutes les ressources
                    <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ========================================================
         PARTNERS
    ======================================================== --}}
    @if ($partners->isNotEmpty())
    <section class="mt-100 section-padding" style="background-color: var(--color-background, #f8f9fa);">
        <div class="container">
            <div class="section-headings text-center mb-60">
                <div class="subheading text-20 subheading-bg">
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="currentColor"/>
                    </svg>
                    Partenaires
                </div>
                <h2 class="heading text-50 fw-700">Nos Partenaires</h2>
            </div>
            <div class="d-flex flex-wrap justify-content-center align-items-center gap-5">
                @foreach ($partners as $partner)
                <div class="partner-logo text-center">
                    @if ($partner->logo_path)
                        <img
                            src="{{ Storage::url($partner->logo_path) }}"
                            alt="{{ $partner->titre }}"
                            loading="lazy"
                            style="max-height: 80px; max-width: 180px; object-fit: contain;"
                        >
                    @else
                        <span class="text text-18 fw-600">{{ $partner->titre }}</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</main>
@endsection
