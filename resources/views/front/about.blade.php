@php
    use Illuminate\Support\Facades\Storage;
@endphp
@extends('front.layouts.app')

@section('title', ($settings->company_name ?? 'EYWEP') . ' - À propos')
@section('description', 'Découvrez la mission, la vision et les valeurs de ' . ($settings->company_name ?? 'EYWEP') . '.')

@section('content')
<main>

    @include('front.partials.page-banner', ['bannerTitle' => 'À propos'])

    @php
        // ── Textes modifiables directement ici ──────────────────────────────
        $aboutTitle   = 'À propos de ' . ($settings->company_name ?? 'EYWEP');
        $aboutLead    = 'EYWEP (Entrepreneurship & Youth Work Empowerment Program) est un programme dédié à la promotion de l\'entrepreneuriat jeune en Afrique centrale.';
        $aboutBody    = 'Depuis notre création, nous accompagnons des centaines de jeunes entrepreneurs à travers des formations, des ateliers pratiques, des financements seed et un réseau de mentors expérimentés. Notre mission est de transformer les idées en projets viables et de créer un écosystème entrepreneurial fort et durable. En partenariat avec des institutions publiques et privées, nous offrons des ressources uniques pour que chaque jeune puisse réaliser son plein potentiel économique.';
        $heroImgs   = $settings->hero_images ?? [];
        $aboutImage = !empty($heroImgs)
            ? Storage::url($heroImgs[0])
            : asset('front-assets/consulo/img/slider/hero-1.jpg');
        $aboutBullets = [
            'Formation pratique et accompagnement personnalisé pour chaque entrepreneur.',
            'Accès à un réseau de mentors expérimentés et de partenaires stratégiques.',
            'Financement seed et ressources pour concrétiser les idées innovantes.',
            'Présence dans 15 pays avec un réseau actif de plus de 500 jeunes.',
        ];
        $stats = [
            ['target' => 500, 'suffix' => '+', 'label' => 'Jeunes accompagnés'],
            ['target' => 120, 'suffix' => '+', 'label' => 'Projets financés'],
            ['target' => 15,  'suffix' => '',  'label' => 'Pays couverts'],
            ['target' => 8,   'suffix' => '+', 'label' => 'Années d\'expérience'],
        ];
        $mvv = [
            [
                'title' => 'Notre Mission',
                'text'  => 'Promouvoir l\'entrepreneuriat jeune en fournissant formation, financement et accompagnement pour créer des entreprises durables et à impact social.',
                'icon'  => '<path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>',
            ],
            [
                'title' => 'Notre Vision',
                'text'  => 'Devenir la plateforme de référence de l\'entrepreneuriat jeune en Afrique centrale d\'ici 2030, avec un réseau actif de 10 000 entrepreneurs.',
                'icon'  => '<circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/><path d="M12 1V3M12 21V23M4.22 4.22L5.64 5.64M18.36 18.36L19.78 19.78M1 12H3M21 12H23M4.22 19.78L5.64 18.36M18.36 5.64L19.78 4.22" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>',
            ],
            [
                'title' => 'Nos Valeurs',
                'text'  => 'Excellence, inclusion, innovation et intégrité guident chacune de nos actions et partenariats pour un impact durable.',
                'icon'  => '<path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>',
            ],
        ];
        // ────────────────────────────────────────────────────────────────────
    @endphp

    {{-- INTRO --}}
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <img src="{{ $aboutImage }}" alt="À propos EYWEP" loading="eager"
                        class="radius18 w-100" style="height:auto;">
                </div>
                <div class="col-lg-6">
                    <div class="section-headings mb-3">
                        <div class="subheading text-20 subheading-bg">
                            <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="currentColor"/>
                            </svg>
                            À propos
                        </div>
                        <h1 class="heading text-50 fw-700">{{ $aboutTitle }}</h1>
                    </div>
                    <p class="text text-18 mb-2 fw-500">{{ $aboutLead }}</p>
                    <p class="text text-16 mb-3" style="color:var(--color-foreground-subheading);">{{ $aboutBody }}</p>
                    <ul class="list-unstyled mb-3" style="display:flex; flex-direction:column; gap:10px;">
                        @foreach ($aboutBullets as $bullet)
                        <li class="d-flex align-items-start gap-2">
                            <svg style="flex-shrink:0; margin-top:2px; width:22px; height:22px; color:var(--color-primary);" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <defs><clipPath id="chk-about-{{ $loop->index }}"><rect width="28" height="28" fill="white"/></clipPath></defs>
                                <g clip-path="url(#chk-about-{{ $loop->index }})">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.81362 13.0268C8.34112 12.7113 7.70994 12.783 7.31911 13.196C6.92886 13.6084 6.89211 14.2431 7.23336 14.6975L10.7334 19.3642C10.9445 19.6453 11.2712 19.8168 11.6229 19.8303C11.9741 19.8431 12.313 19.6972 12.5446 19.4324L20.7113 10.0991C21.1144 9.63883 21.0928 8.94525 20.6623 8.51008C20.2318 8.07492 19.5388 8.04692 19.0739 8.44475L11.5786 14.8696L8.81362 13.0268Z" fill="white"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9327 0.515625C6.52939 0.515625 0.519531 6.52549 0.519531 13.9288C0.519531 21.3321 6.52939 27.3419 13.9327 27.3419C21.336 27.3419 27.3458 21.3321 27.3458 13.9288C27.3458 6.52549 21.336 0.515625 13.9327 0.515625ZM13.9327 1.68166C20.6921 1.68166 26.1798 7.16938 26.1798 13.9288C26.1798 20.6882 20.6921 26.1759 13.9327 26.1759C7.17329 26.1759 1.68557 20.6882 1.68557 13.9288C1.68557 7.16938 7.17329 1.68166 13.9327 1.68166Z" fill="currentColor"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13872 12.5389C8.42939 12.0658 7.48265 12.1731 6.89698 12.792C6.31073 13.4115 6.25648 14.363 6.76806 15.0449L10.2681 19.7115C10.5848 20.1339 11.0748 20.3905 11.6021 20.4104C12.1295 20.4302 12.6376 20.2109 12.9852 19.8142L21.1519 10.4809C21.7562 9.78965 21.7241 8.74956 21.0784 8.0974C20.4326 7.44465 19.3926 7.40205 18.6961 7.99938L11.5356 14.1366L9.13872 12.5389ZM8.4918 13.5096L11.2562 15.3529C11.4738 15.4976 11.7608 15.4801 11.9597 15.3103L19.455 8.88547C19.6871 8.68597 20.0342 8.70055 20.2495 8.91814C20.4647 9.13514 20.4752 9.48222 20.274 9.71264L12.1073 19.046C11.9912 19.1778 11.8221 19.2513 11.6459 19.2443C11.4703 19.2379 11.307 19.1521 11.2014 19.0116L7.7014 14.3449C7.53106 14.1174 7.54913 13.8006 7.74455 13.5941C7.93938 13.3876 8.25497 13.3521 8.4918 13.5096Z" fill="currentColor"/>
                                </g>
                            </svg>
                            <span class="text text-16">{{ $bullet }}</span>
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('front.contact') }}" class="button button--primary">
                        Nous contacter
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

    {{-- PARTENAIRES (défilement) --}}
    @if ($partners->isNotEmpty())
    @php $sponsorList = $partners->all(); @endphp
    <section class="section-sponsors py-5" style="background:#fff; overflow:hidden;">
        <div class="container mb-4">
            <div class="section-headings text-center">
                <div class="subheading text-20 subheading-bg d-inline-flex">
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="currentColor"/>
                    </svg>
                    Nos partenaires
                </div>
            </div>
        </div>
        <div class="sponsors-track-wrapper" style="position:relative;">
            <div style="pointer-events:none;position:absolute;top:0;left:0;width:120px;height:100%;background:linear-gradient(to right,#fff,transparent);z-index:2;"></div>
            <div style="pointer-events:none;position:absolute;top:0;right:0;width:120px;height:100%;background:linear-gradient(to left,#fff,transparent);z-index:2;"></div>
            <div class="sponsors-track d-flex align-items-center gap-5" style="width:max-content;">
                @foreach (array_merge($sponsorList, $sponsorList, $sponsorList, $sponsorList) as $partner)
                <div class="sponsor-item flex-shrink-0 text-center px-3">
                    @if ($partner->lien)
                        <a href="{{ $partner->lien }}" target="_blank" rel="noopener noreferrer" class="sponsor-link" title="{{ $partner->titre }}">
                    @endif
                    @if ($partner->logo_path)
                        <img src="{{ Storage::url($partner->logo_path) }}" alt="{{ $partner->titre }}" loading="lazy" class="sponsor-logo">
                    @else
                        <span class="fw-600 text-16" style="color:var(--color-foreground-subheading);white-space:nowrap;">{{ $partner->titre }}</span>
                    @endif
                    @if ($partner->lien)
                        </a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        <style>
            @keyframes sponsors-scroll {
                from { transform: translateX(0); }
                to   { transform: translateX(-25%); }
            }
            .sponsors-track { animation: sponsors-scroll 15s linear infinite; }
            .sponsors-track-wrapper:hover .sponsors-track { animation-play-state: paused; }
            @media (prefers-reduced-motion: reduce) { .sponsors-track { animation: none !important; } }
            .sponsor-logo { max-height:70px; max-width:160px; object-fit:contain; filter:grayscale(60%); opacity:.8; transition:filter .3s,opacity .3s,transform .3s; }
            .sponsor-item:hover .sponsor-logo { filter:grayscale(0); opacity:1; transform:scale(1.05); }
            .sponsor-link { display:inline-block; text-decoration:none; }
        </style>
    </section>
    @endif

    {{-- COUNTER UP --}}
    <counter-up class="counter-up d-block mt-40">
        <div class="container">
            <div class="counter-up-box radius18">
                <div class="row product-grid text-center">
                    @foreach ($stats as $i => $stat)
                    <div class="col-12 col-md-3" data-aos="fade-up" @if($i > 0) data-aos-delay="{{ $i * 100 }}" @endif>
                        <div class="counter-item">
                            <h2 class="heading text-50" data-target="{{ $stat['target'] }}">0<span>{{ $stat['suffix'] }}</span></h2>
                            <div class="text text-18 fw-500">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </counter-up>

    {{-- MISSION / VISION / VALEURS --}}
    <section class="py-5 mt-40" style="background:#f8f9fa;">
        <div class="container">
            <div class="section-headings text-center mb-40">
                <div class="subheading text-20 subheading-bg">
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="currentColor"/>
                    </svg>
                    Ce qui nous guide
                </div>
                <h2 class="heading text-50 fw-700">Mission, Vision & Valeurs</h2>
            </div>
            <div class="row g-3">
                @foreach ($mvv as $item)
                <div class="col-md-4">
                    <div class="radius18 p-4 h-100" style="background:#fff; border:1px solid rgba(0,0,0,.06);">
                        <div class="mb-3" style="width:48px; height:48px; border-radius:10px; background:var(--color-primary); display:flex; align-items:center; justify-content:center;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color:#fff;">{!! $item['icon'] !!}</svg>
                        </div>
                        <h3 class="heading text-20 fw-700 mb-2">{{ $item['title'] }}</h3>
                        <p class="text text-15 mb-0" style="color:var(--color-foreground-subheading);">{{ $item['text'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


</main>
@endsection
