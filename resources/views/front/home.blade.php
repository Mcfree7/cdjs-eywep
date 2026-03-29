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

    @php
        $heroVideoUrl      = $settings->hero_video_url ?? null;
        $heroVideoFilePath = $settings->hero_video_file_path ?? null;
        $heroVideoEmbed    = null;
        $heroVideoIsLocal  = false;

        if ($heroVideoFilePath) {
            // Fichier uploadé en local — priorité sur l'URL externe
            $heroVideoEmbed   = Storage::url($heroVideoFilePath);
            $heroVideoIsLocal = true;
        } elseif ($heroVideoUrl) {
            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\s]+)/', $heroVideoUrl, $ytM);
            preg_match('/vimeo\.com\/(\d+)/', $heroVideoUrl, $vimM);
            if (!empty($ytM[1])) {
                $heroVideoEmbed = 'https://www.youtube.com/embed/' . $ytM[1] . '?rel=0&modestbranding=1';
            } elseif (!empty($vimM[1])) {
                $heroVideoEmbed = 'https://player.vimeo.com/video/' . $vimM[1];
            } else {
                $heroVideoEmbed   = Str::startsWith($heroVideoUrl, ['http', '//']) ? $heroVideoUrl : Storage::url($heroVideoUrl);
                $heroVideoIsLocal = true;
            }
        }
        $heroVideoActive = !empty($heroVideoEmbed);
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
                                <div class="row align-items-center w-100 g-4">
                                    {{-- Texte --}}
                                    <div class="{{ $heroVideoActive ? 'col-lg-6' : 'col-12' }}">
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
                                    {{-- Vidéo miniature (uniquement si renseignée) --}}
                                    @if ($heroVideoActive)
                                    <div class="col-lg-6 d-none d-lg-block" style="padding-top: 80px;">
                                        <div class="hv-outer">
                                            {{-- Badge --}}
                                            <div class="hv-badge">
                                                <span class="hv-dot"></span>
                                                Présentation
                                            </div>
                                            {{-- Carte vidéo --}}
                                            <div class="hv-card">
                                                <div class="hv-ratio">
                                                    @if (!$heroVideoIsLocal)
                                                        <iframe id="hv-iframe"
                                                            src="{{ $heroVideoEmbed }}"
                                                            style="position:absolute;inset:0;width:100%;height:100%;border:0;"
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                            allowfullscreen loading="lazy"
                                                        ></iframe>
                                                    @else
                                                        <video id="hv-video"
                                                            src="{{ $heroVideoEmbed }}"
                                                            preload="metadata"
                                                            style="position:absolute;inset:0;width:100%;height:100%;border:0;object-fit:cover;"
                                                        ></video>
                                                    @endif
                                                    {{-- Overlay play --}}
                                                    <div id="hv-play" class="hv-overlay">
                                                        <div class="hv-pulse-ring"></div>
                                                        <div class="hv-play-btn">
                                                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                                                <path d="M7 4.5v15l13-7.5L7 4.5z" fill="currentColor"/>
                                                            </svg>
                                                        </div>
                                                        <span class="hv-label">Voir la vidéo</span>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Déco bas --}}
                                            <div class="hv-footer">
                                                <div class="hv-bar"></div>
                                                <span class="hv-duration">{{ $settings->company_name ?? 'EYWEP' }}</span>
                                                <div class="hv-bar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <style>
                                    .hv-outer {
                                        display: flex;
                                        flex-direction: column;
                                        gap: 12px;
                                    }
                                    .hv-badge {
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 8px;
                                        background: rgba(255,255,255,.15);
                                        border: 1px solid rgba(255,255,255,.3);
                                        backdrop-filter: blur(8px);
                                        color: #fff;
                                        font-size: 12px;
                                        font-weight: 600;
                                        letter-spacing: .06em;
                                        text-transform: uppercase;
                                        padding: 6px 14px;
                                        border-radius: 999px;
                                        width: fit-content;
                                    }
                                    .hv-dot {
                                        width: 8px; height: 8px;
                                        border-radius: 50%;
                                        background: #4ade80;
                                        box-shadow: 0 0 6px #4ade80;
                                        animation: hv-blink 1.6s ease-in-out infinite;
                                    }
                                    @keyframes hv-blink {
                                        0%,100% { opacity:1; } 50% { opacity:.3; }
                                    }
                                    .hv-card {
                                        border-radius: 20px;
                                        overflow: hidden;
                                        border: 2px solid rgba(255,255,255,.35);
                                        box-shadow: 0 24px 64px rgba(0,0,0,.55), 0 0 0 1px rgba(255,255,255,.08);
                                    }
                                    .hv-ratio {
                                        position: relative;
                                        padding-top: 56.25%;
                                    }
                                    .hv-overlay {
                                        position: absolute;
                                        inset: 0;
                                        display: flex;
                                        flex-direction: column;
                                        align-items: center;
                                        justify-content: center;
                                        gap: 16px;
                                        background: linear-gradient(135deg, rgba(0,0,0,.45) 0%, rgba(0,0,0,.25) 100%);
                                        cursor: pointer;
                                        transition: background .3s;
                                        z-index: 5;
                                    }
                                    .hv-overlay:hover { background: linear-gradient(135deg, rgba(0,0,0,.25) 0%, rgba(0,0,0,.1) 100%); }
                                    .hv-pulse-ring {
                                        position: absolute;
                                        width: 96px; height: 96px;
                                        border-radius: 50%;
                                        border: 2px solid rgba(255,255,255,.5);
                                        animation: hv-pulse 2s ease-out infinite;
                                    }
                                    @keyframes hv-pulse {
                                        0%   { transform: scale(1);   opacity:.6; }
                                        100% { transform: scale(1.7); opacity:0;  }
                                    }
                                    .hv-play-btn {
                                        width: 76px; height: 76px;
                                        border-radius: 50%;
                                        background: rgba(255,255,255,.95);
                                        color: #111;
                                        display: flex; align-items: center; justify-content: center;
                                        box-shadow: 0 4px 28px rgba(0,0,0,.4);
                                        transition: transform .25s, box-shadow .25s;
                                        padding-left: 4px;
                                        position: relative; z-index: 1;
                                    }
                                    .hv-overlay:hover .hv-play-btn {
                                        transform: scale(1.1);
                                        box-shadow: 0 8px 36px rgba(0,0,0,.55);
                                    }
                                    .hv-label {
                                        color: #fff;
                                        font-size: 13px;
                                        font-weight: 600;
                                        letter-spacing: .05em;
                                        text-shadow: 0 1px 6px rgba(0,0,0,.6);
                                    }
                                    .hv-footer {
                                        display: flex;
                                        align-items: center;
                                        gap: 10px;
                                    }
                                    .hv-bar {
                                        flex: 1;
                                        height: 1px;
                                        background: rgba(255,255,255,.25);
                                    }
                                    .hv-duration {
                                        color: rgba(255,255,255,.6);
                                        font-size: 11px;
                                        font-weight: 500;
                                        letter-spacing: .08em;
                                        white-space: nowrap;
                                    }
                                    </style>
                                    <script>
                                    (function(){
                                        document.addEventListener('DOMContentLoaded', function(){
                                            var overlay = document.getElementById('hv-play');
                                            var video   = document.getElementById('hv-video');
                                            var iframe  = document.getElementById('hv-iframe');
                                            if (!overlay) return;
                                            overlay.addEventListener('click', function(){
                                                overlay.style.display = 'none';
                                                if (video) {
                                                    video.controls = true;
                                                    video.play();
                                                } else if (iframe) {
                                                    iframe.src += (iframe.src.includes('?') ? '&' : '?') + 'autoplay=1';
                                                }
                                            });
                                        });
                                    })();
                                    </script>
                                    @endif
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
                            style="height:auto;"
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
                    Nos Partenaires
                </div>
            </div>
        </div>

        {{-- Défilement CSS infini (aucun JS requis) --}}
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
                        <img
                            src="{{ Storage::url($partner->logo_path) }}"
                            alt="{{ $partner->titre }}"
                            loading="lazy"
                            class="sponsor-logo"
                        >
                    @else
                        <span class="fw-600 text-16" style="color:var(--color-foreground-subheading); white-space:nowrap;">{{ $partner->titre }}</span>
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
            .sponsors-track {
                animation: sponsors-scroll 15s linear infinite;
            }
            .sponsors-track-wrapper:hover .sponsors-track {
                animation-play-state: paused;
            }
            @media (prefers-reduced-motion: reduce) {
                .sponsors-track { animation: none !important; }
            }
            .sponsor-logo {
                max-height: 70px;
                max-width: 160px;
                object-fit: contain;
                filter: grayscale(60%);
                opacity: .8;
                transition: filter .3s, opacity .3s, transform .3s;
            }
            .sponsor-item:hover .sponsor-logo {
                filter: grayscale(0);
                opacity: 1;
                transform: scale(1.05);
            }
            .sponsor-link {
                display: inline-block;
                text-decoration: none;
            }
        </style>
    </section>
    @endif

    {{-- ========================================================
         LATEST ARTICLES
    ======================================================== --}}
    @if ($articles->isNotEmpty())
    @php $featuredArticle = $articles->first(); $restArticles = $articles->skip(1); @endphp
    <section class="featured-blog bg-transparent section-padding mt-100">
        <div class="container">
            <div class="section-headings text-center mb-3">
                <div class="subheading text-20 subheading-bg" data-aos="fade-up">
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="CurrentColor"/>
                    </svg>
                    <span>Actualités</span>
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="CurrentColor"/>
                    </svg>
                </div>
                <h2 class="heading text-50 fw-700" data-aos="fade-up" data-aos-delay="50">Derniers Articles</h2>
            </div>
            <div class="row product-grid">

                {{-- Article vedette --}}
                <div class="col-12 col-xl-6">
                    <div class="card-blog-list" data-aos="fade-up">
                        <div class="card-blog-list-media radius18">
                            <div class="media">
                                <img
                                    src="{{ $featuredArticle->coverImage ? Storage::url($featuredArticle->coverImage->image_path) : asset('front-assets/consulo/img/blog/9.jpg') }}"
                                    alt="{{ $featuredArticle->titre }}"
                                    width="1000"
                                    height="707"
                                    loading="eager"
                                >
                            </div>
                        </div>

                        <div class="card-blog-meta">
                            <div class="card-blog-meta-item text text-18">
                                <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.0007 0.046875C6.95088 0.046875 5.94406 0.463912 5.20173 1.20624C4.4594 1.94858 4.04236 2.95539 4.04236 4.00521C4.04236 5.05502 4.4594 6.06184 5.20173 6.80417C5.94406 7.5465 6.95088 7.96354 8.0007 7.96354C9.05051 7.96354 10.0573 7.5465 10.7997 6.80417C11.542 6.06184 11.959 5.05502 11.959 4.00521C11.959 2.95539 11.542 1.94858 10.7997 1.20624C10.0573 0.463912 9.05051 0.046875 8.0007 0.046875ZM5.29236 4.00521C5.29236 3.28691 5.57771 2.59804 6.08562 2.09013C6.59353 1.58222 7.2824 1.29688 8.0007 1.29688C8.71899 1.29688 9.40787 1.58222 9.91578 2.09013C10.4237 2.59804 10.709 3.28691 10.709 4.00521C10.709 4.7235 10.4237 5.41238 9.91578 5.92029C9.40787 6.4282 8.71899 6.71354 8.0007 6.71354C7.2824 6.71354 6.59353 6.4282 6.08562 5.92029C5.57771 5.41238 5.29236 4.7235 5.29236 4.00521ZM8.0007 9.21354C6.0732 9.21354 4.29653 9.65187 2.9807 10.3919C1.68403 11.1219 0.709031 12.2269 0.709031 13.5885V13.6735C0.708198 14.6419 0.707364 15.8569 1.7732 16.7252C2.29736 17.1519 3.03153 17.456 4.0232 17.656C5.01653 17.8577 6.31236 17.9635 8.0007 17.9635C9.68903 17.9635 10.984 17.8577 11.979 17.656C12.9707 17.456 13.704 17.1519 14.229 16.7252C15.2949 15.8569 15.2932 14.6419 15.2924 13.6735V13.5885C15.2924 12.2269 14.3174 11.1219 13.0215 10.3919C11.7049 9.65187 9.92903 9.21354 8.0007 9.21354ZM1.95903 13.5885C1.95903 12.8794 2.47736 12.1094 3.5932 11.4819C4.68986 10.8652 6.24653 10.4635 8.00153 10.4635C9.75486 10.4635 11.3115 10.8652 12.4082 11.4819C13.5249 12.1094 14.0424 12.8794 14.0424 13.5885C14.0424 14.6785 14.009 15.2919 13.439 15.7552C13.1307 16.0069 12.614 16.2527 11.7307 16.431C10.8499 16.6094 9.6457 16.7135 8.0007 16.7135C6.3557 16.7135 5.1507 16.6094 4.2707 16.431C3.38736 16.2527 2.8707 16.0069 2.56236 15.756C1.99236 15.2919 1.95903 14.6785 1.95903 13.5885Z" fill="currentColor"/>
                                </svg>
                                Admin
                            </div>
                            @if ($featuredArticle->datePublication)
                            <div class="card-blog-meta-item text text-18">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.1667 10.6667C13.3877 10.6667 13.5996 10.5789 13.7559 10.4226C13.9122 10.2663 14 10.0543 14 9.83333C14 9.61232 13.9122 9.40036 13.7559 9.24408C13.5996 9.0878 13.3877 9 13.1667 9C12.9457 9 12.7337 9.0878 12.5774 9.24408C12.4211 9.40036 12.3333 9.61232 12.3333 9.83333C12.3333 10.0543 12.4211 10.2663 12.5774 10.4226C12.7337 10.5789 12.9457 10.6667 13.1667 10.6667Z" fill="currentColor"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.83268 0.453125C4.99844 0.453125 5.15741 0.518973 5.27462 0.636183C5.39183 0.753394 5.45768 0.912365 5.45768 1.07812V1.71396C6.00935 1.70312 6.61685 1.70312 7.28518 1.70312H10.7127C11.3818 1.70312 11.9893 1.70312 12.541 1.71396V1.07812C12.541 0.912365 12.6069 0.753394 12.7241 0.636183C12.8413 0.518973 13.0003 0.453125 13.166 0.453125C13.3318 0.453125 13.4907 0.518973 13.608 0.636183C13.7252 0.753394 13.791 0.912365 13.791 1.07812V1.76729C14.0077 1.78396 14.2127 1.80479 14.4068 1.83063C15.3835 1.96229 16.1743 2.23896 16.7985 2.86229C17.4218 3.48646 17.6985 4.27729 17.8302 5.25396C17.9577 6.20396 17.9577 7.41646 17.9577 8.94812V10.7081C17.9577 12.2398 17.9577 13.4531 17.8302 14.4023C17.6985 15.379 17.4218 16.1698 16.7985 16.794C16.1743 17.4173 15.3835 17.694 14.4068 17.8256C13.4568 17.9531 12.2443 17.9531 10.7127 17.9531H7.28602C5.75435 17.9531 4.54102 17.9531 3.59185 17.8256C2.61518 17.694 1.82435 17.4173 1.20018 16.794C0.576849 16.1698 0.300182 15.379 0.168516 14.4023C0.0410156 13.4523 0.0410156 12.2398 0.0410156 10.7081V8.94812C0.0410156 7.41646 0.0410156 6.20312 0.168516 5.25396C0.300182 4.27729 0.576849 3.48646 1.20018 2.86229C1.82435 2.23896 2.61518 1.96229 3.59185 1.83063C3.78602 1.80479 3.99185 1.78396 4.20768 1.76729V1.07812C4.20768 0.912365 4.27353 0.753394 4.39074 0.636183C4.50795 0.518973 4.66692 0.453125 4.83268 0.453125ZM3.75768 3.06979C2.92018 3.18229 2.43685 3.39396 2.08435 3.74646C1.73185 4.09896 1.52018 4.58229 1.40768 5.42062C1.38852 5.56229 1.37268 5.71229 1.35935 5.86979H16.6393C16.626 5.71146 16.6102 5.56229 16.591 5.41979C16.4785 4.58229 16.2668 4.09896 15.9143 3.74646C15.5618 3.39396 15.0785 3.18229 14.2402 3.06979C13.3843 2.95479 12.2552 2.95312 10.666 2.95312H7.33268C5.74352 2.95312 4.61518 2.95479 3.75768 3.06979ZM1.29102 8.99479C1.29102 8.28312 1.29102 7.66396 1.30185 7.11979H16.6968C16.7077 7.66396 16.7077 8.28312 16.7077 8.99479V10.6615C16.7077 12.2506 16.706 13.3798 16.591 14.2365C16.4785 15.074 16.2668 15.5573 15.9143 15.9098C15.5618 16.2623 15.0785 16.474 14.2402 16.5865C13.3843 16.7015 12.2552 16.7031 10.666 16.7031H7.33268C5.74352 16.7031 4.61518 16.7015 3.75768 16.5865C2.92018 16.474 2.43685 16.2623 2.08435 15.9098C1.73185 15.5573 1.52018 15.074 1.40768 14.2356C1.29268 13.3798 1.29102 12.2506 1.29102 10.6615V8.99479Z" fill="currentColor"/>
                                </svg>
                                {{ $featuredArticle->datePublication->format('d M Y') }}
                            </div>
                            @endif
                        </div>

                        <h2 class="card-blog-heading heading text-32">
                            <a href="{{ route('front.articles.show', $featuredArticle) }}" class="heading text-32">
                                {{ $featuredArticle->titre }}
                            </a>
                        </h2>

                        <div class="buttons">
                            <a href="{{ route('front.articles.show', $featuredArticle) }}" class="button--cta" aria-label="Lire l'article">
                                Lire la suite
                                <svg viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.16668 0.833333C2.16668 0.61232 2.25448 0.400358 2.41076 0.244078C2.56704 0.0877975 2.779 0 3.00001 0H9.66668C9.88769 0 10.0997 0.0877975 10.2559 0.244078C10.4122 0.400358 10.5 0.61232 10.5 0.833333V7.5C10.5 7.72101 10.4122 7.93297 10.2559 8.08926C10.0997 8.24554 9.88769 8.33333 9.66668 8.33333C9.44567 8.33333 9.2337 8.24554 9.07742 8.08926C8.92114 7.93297 8.83335 7.72101 8.83335 7.5V2.845L1.92251 9.75583C1.76535 9.90763 1.55484 9.99163 1.33635 9.98973C1.11785 9.98783 0.908839 9.90019 0.754332 9.74568C0.599825 9.59118 0.512184 9.38216 0.510285 9.16367C0.508387 8.94517 0.592382 8.73467 0.744181 8.5775L7.65501 1.66667H3.00001C2.779 1.66667 2.56704 1.57887 2.41076 1.42259C2.25448 1.26631 2.16668 1.05435 2.16668 0.833333Z" fill="currentColor"/>
                                </svg>
                                <span class="visually-hidden">Lire cet article</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Articles suivants en horizontal --}}
                <div class="col-12 col-xl-6">
                    <div class="horizontal-blogs">
                        @foreach ($restArticles as $article)
                        <div class="card-blog-list-horizontal radius18" data-aos="fade-up">
                            <div class="card-blog-list-media">
                                <div class="media">
                                    <img
                                        src="{{ $article->coverImage ? Storage::url($article->coverImage->image_path) : asset('front-assets/consulo/img/blog/2.jpg') }}"
                                        alt="{{ $article->titre }}"
                                        width="1000"
                                        height="707"
                                        loading="lazy"
                                    >
                                </div>
                            </div>
                            <div class="card-blog-content">
                                <div class="card-blog-meta">
                                    <div class="card-blog-meta-item text text-16">
                                        <svg width="14" height="16" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.0007 0.046875C6.95088 0.046875 5.94406 0.463912 5.20173 1.20624C4.4594 1.94858 4.04236 2.95539 4.04236 4.00521C4.04236 5.05502 4.4594 6.06184 5.20173 6.80417C5.94406 7.5465 6.95088 7.96354 8.0007 7.96354C9.05051 7.96354 10.0573 7.5465 10.7997 6.80417C11.542 6.06184 11.959 5.05502 11.959 4.00521C11.959 2.95539 11.542 1.94858 10.7997 1.20624C10.0573 0.463912 9.05051 0.046875 8.0007 0.046875ZM5.29236 4.00521C5.29236 3.28691 5.57771 2.59804 6.08562 2.09013C6.59353 1.58222 7.2824 1.29688 8.0007 1.29688C8.71899 1.29688 9.40787 1.58222 9.91578 2.09013C10.4237 2.59804 10.709 3.28691 10.709 4.00521C10.709 4.7235 10.4237 5.41238 9.91578 5.92029C9.40787 6.4282 8.71899 6.71354 8.0007 6.71354C7.2824 6.71354 6.59353 6.4282 6.08562 5.92029C5.57771 5.41238 5.29236 4.7235 5.29236 4.00521ZM8.0007 9.21354C6.0732 9.21354 4.29653 9.65187 2.9807 10.3919C1.68403 11.1219 0.709031 12.2269 0.709031 13.5885V13.6735C0.708198 14.6419 0.707364 15.8569 1.7732 16.7252C2.29736 17.1519 3.03153 17.456 4.0232 17.656C5.01653 17.8577 6.31236 17.9635 8.0007 17.9635C9.68903 17.9635 10.984 17.8577 11.979 17.656C12.9707 17.456 13.704 17.1519 14.229 16.7252C15.2949 15.8569 15.2932 14.6419 15.2924 13.6735V13.5885C15.2924 12.2269 14.3174 11.1219 13.0215 10.3919C11.7049 9.65187 9.92903 9.21354 8.0007 9.21354ZM1.95903 13.5885C1.95903 12.8794 2.47736 12.1094 3.5932 11.4819C4.68986 10.8652 6.24653 10.4635 8.00153 10.4635C9.75486 10.4635 11.3115 10.8652 12.4082 11.4819C13.5249 12.1094 14.0424 12.8794 14.0424 13.5885C14.0424 14.6785 14.009 15.2919 13.439 15.7552C13.1307 16.0069 12.614 16.2527 11.7307 16.431C10.8499 16.6094 9.6457 16.7135 8.0007 16.7135C6.3557 16.7135 5.1507 16.6094 4.2707 16.431C3.38736 16.2527 2.8707 16.0069 2.56236 15.756C1.99236 15.2919 1.95903 14.6785 1.95903 13.5885Z" fill="currentColor"/>
                                        </svg>
                                        Admin
                                    </div>
                                    @if ($article->datePublication)
                                    <div class="card-blog-meta-item text text-16">
                                        {{ $article->datePublication->format('d M Y') }}
                                    </div>
                                    @endif
                                </div>
                                <h2 class="card-blog-heading heading text-24">
                                    <a href="{{ route('front.articles.show', $article) }}" class="heading text-24">
                                        {{ $article->titre }}
                                    </a>
                                </h2>
                                <div class="buttons">
                                    <a href="{{ route('front.articles.show', $article) }}" class="button--cta" aria-label="Lire l'article">
                                        Lire la suite
                                        <svg viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.16668 0.833333C2.16668 0.61232 2.25448 0.400358 2.41076 0.244078C2.56704 0.0877975 2.779 0 3.00001 0H9.66668C9.88769 0 10.0997 0.0877975 10.2559 0.244078C10.4122 0.400358 10.5 0.61232 10.5 0.833333V7.5C10.5 7.72101 10.4122 7.93297 10.2559 8.08926C10.0997 8.24554 9.88769 8.33333 9.66668 8.33333C9.44567 8.33333 9.2337 8.24554 9.07742 8.08926C8.92114 7.93297 8.83335 7.72101 8.83335 7.5V2.845L1.92251 9.75583C1.76535 9.90763 1.55484 9.99163 1.33635 9.98973C1.11785 9.98783 0.908839 9.90019 0.754332 9.74568C0.599825 9.59118 0.512184 9.38216 0.510285 9.16367C0.508387 8.94517 0.592382 8.73467 0.744181 8.5775L7.65501 1.66667H3.00001C2.779 1.66667 2.56704 1.57887 2.41076 1.42259C2.25448 1.26631 2.16668 1.05435 2.16668 0.833333Z" fill="currentColor"/>
                                        </svg>
                                        <span class="visually-hidden">Lire cet article</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="buttons buttons-discover" data-aos="fade-up">
                <a href="{{ route('front.articles.index') }}" class="button button--secondary" aria-label="Voir tous les articles">
                    Voir tous les articles
                    <span class="svg-wrapper">
                        <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ========================================================
         LATEST ACTIVITIES
    ======================================================== --}}
    @if ($activities->isNotEmpty())
    <section class="featured-blog section-padding" style="margin-top: 30px;">
        <div class="container">
            <div class="section-headings text-center mb-3">
                <div class="subheading text-20 subheading-bg" data-aos="fade-up">
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <g clip-path="url(#clip-act-home)">
                            <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="currentColor"/>
                        </g>
                        <defs><clipPath id="clip-act-home"><rect width="14" height="14" fill="currentColor"/></clipPath></defs>
                    </svg>
                    Activités
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <g clip-path="url(#clip-act-home2)">
                            <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="currentColor"/>
                        </g>
                        <defs><clipPath id="clip-act-home2"><rect width="14" height="14" fill="currentColor"/></clipPath></defs>
                    </svg>
                </div>
                <h2 class="heading text-50" data-aos="fade-up" data-aos-delay="50">Nos Dernières Activités</h2>
            </div>

            {{-- Swiper slider --}}
            <div class="activities-swiper swiper" data-aos="fade-up" data-aos-delay="100" style="padding-bottom: 50px;">
                <div class="swiper-wrapper">
                    @foreach ($activities as $activity)
                    <div class="swiper-slide">
                        <div class="card-blog radius18">
                            <div class="card-blog-top">
                                <div class="card-blog-meta">
                                    <div class="card-blog-meta-item text text-18">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.0007 0.046875C6.95088 0.046875 5.94406 0.463912 5.20173 1.20624C4.4594 1.94858 4.04236 2.95539 4.04236 4.00521C4.04236 5.05502 4.4594 6.06184 5.20173 6.80417C5.94406 7.5465 6.95088 7.96354 8.0007 7.96354C9.05051 7.96354 10.0573 7.5465 10.7997 6.80417C11.542 6.06184 11.959 5.05502 11.959 4.00521C11.959 2.95539 11.542 1.94858 10.7997 1.20624C10.0573 0.463912 9.05051 0.046875 8.0007 0.046875ZM5.29236 4.00521C5.29236 3.28691 5.57771 2.59804 6.08562 2.09013C6.59353 1.58222 7.2824 1.29688 8.0007 1.29688C8.71899 1.29688 9.40787 1.58222 9.91578 2.09013C10.4237 2.59804 10.709 3.28691 10.709 4.00521C10.709 4.7235 10.4237 5.41238 9.91578 5.92029C9.40787 6.4282 8.71899 6.71354 8.0007 6.71354C7.2824 6.71354 6.59353 6.4282 6.08562 5.92029C5.57771 5.41238 5.29236 4.7235 5.29236 4.00521ZM8.0007 9.21354C6.0732 9.21354 4.29653 9.65187 2.9807 10.3919C1.68403 11.1219 0.709031 12.2269 0.709031 13.5885V13.6735C0.708198 14.6419 0.707364 15.8569 1.7732 16.7252C2.29736 17.1519 3.03153 17.456 4.0232 17.656C5.01653 17.8577 6.31236 17.9635 8.0007 17.9635C9.68903 17.9635 10.984 17.8577 11.979 17.656C12.9707 17.456 13.704 17.1519 14.229 16.7252C15.2949 15.8569 15.2932 14.6419 15.2924 13.6735V13.5885C15.2924 12.2269 14.3174 11.1219 13.0215 10.3919C11.7049 9.65187 9.92903 9.21354 8.0007 9.21354ZM1.95903 13.5885C1.95903 12.8794 2.47736 12.1094 3.5932 11.4819C4.68986 10.8652 6.24653 10.4635 8.00153 10.4635C9.75486 10.4635 11.3115 10.8652 12.4082 11.4819C13.5249 12.1094 14.0424 12.8794 14.0424 13.5885C14.0424 14.6785 14.009 15.2919 13.439 15.7552C13.1307 16.0069 12.614 16.2527 11.7307 16.431C10.8499 16.6094 9.6457 16.7135 8.0007 16.7135C6.3557 16.7135 5.1507 16.6094 4.2707 16.431C3.38736 16.2527 2.8707 16.0069 2.56236 15.756C1.99236 15.2919 1.95903 14.6785 1.95903 13.5885Z" fill="currentColor"/>
                                        </svg>
                                        Admin
                                    </div>
                                    @if ($activity->datePublication)
                                    <div class="card-blog-meta-item text text-18">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.1667 10.6667C13.3877 10.6667 13.5996 10.5789 13.7559 10.4226C13.9122 10.2663 14 10.0543 14 9.83333C14 9.61232 13.9122 9.40036 13.7559 9.24408C13.5996 9.0878 13.3877 9 13.1667 9C12.9457 9 12.7337 9.0878 12.5774 9.24408C12.4211 9.40036 12.3333 9.61232 12.3333 9.83333C12.3333 10.0543 12.4211 10.2663 12.5774 10.4226C12.7337 10.5789 12.9457 10.6667 13.1667 10.6667Z" fill="currentColor"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.83268 0.453125C4.99844 0.453125 5.15741 0.518973 5.27462 0.636183C5.39183 0.753394 5.45768 0.912365 5.45768 1.07812V1.71396C6.00935 1.70312 6.61685 1.70312 7.28518 1.70312H10.7127C11.3818 1.70312 11.9893 1.70312 12.541 1.71396V1.07812C12.541 0.912365 12.6069 0.753394 12.7241 0.636183C12.8413 0.518973 13.0003 0.453125 13.166 0.453125C13.3318 0.453125 13.4907 0.518973 13.608 0.636183C13.7252 0.753394 13.791 0.912365 13.791 1.07812V1.76729C14.0077 1.78396 14.2127 1.80479 14.4068 1.83063C15.3835 1.96229 16.1743 2.23896 16.7985 2.86229C17.4218 3.48646 17.6985 4.27729 17.8302 5.25396C17.9577 6.20396 17.9577 7.41646 17.9577 8.94812V10.7081C17.9577 12.2398 17.9577 13.4531 17.8302 14.4023C17.6985 15.379 17.4218 16.1698 16.7985 16.794C16.1743 17.4173 15.3835 17.694 14.4068 17.8256C13.4568 17.9531 12.2443 17.9531 10.7127 17.9531H7.28602C5.75435 17.9531 4.54102 17.9531 3.59185 17.8256C2.61518 17.694 1.82435 17.4173 1.20018 16.794C0.576849 16.1698 0.300182 15.379 0.168516 14.4023C0.0410156 13.4523 0.0410156 12.2398 0.0410156 10.7081V8.94812C0.0410156 7.41646 0.0410156 6.20312 0.168516 5.25396C0.300182 4.27729 0.576849 3.48646 1.20018 2.86229C1.82435 2.23896 2.61518 1.96229 3.59185 1.83063C3.78602 1.80479 3.99185 1.78396 4.20768 1.76729V1.07812C4.20768 0.912365 4.27353 0.753394 4.39074 0.636183C4.50795 0.518973 4.66692 0.453125 4.83268 0.453125ZM3.75768 3.06979C2.92018 3.18229 2.43685 3.39396 2.08435 3.74646C1.73185 4.09896 1.52018 4.58229 1.40768 5.42062C1.38852 5.56229 1.37268 5.71229 1.35935 5.86979H16.6393C16.626 5.71146 16.6102 5.56229 16.591 5.41979C16.4785 4.58229 16.2668 4.09896 15.9143 3.74646C15.5618 3.39396 15.0785 3.18229 14.2402 3.06979C13.3843 2.95479 12.2552 2.95312 10.666 2.95312H7.33268C5.74352 2.95312 4.61518 2.95479 3.75768 3.06979ZM1.29102 8.99479C1.29102 8.28312 1.29102 7.66396 1.30185 7.11979H16.6968C16.7077 7.66396 16.7077 8.28312 16.7077 8.99479V10.6615C16.7077 12.2506 16.706 13.3798 16.591 14.2365C16.4785 15.074 16.2668 15.5573 15.9143 15.9098C15.5618 16.2623 15.0785 16.474 14.2402 16.5865C13.3843 16.7015 12.2552 16.7031 10.666 16.7031H7.33268C5.74352 16.7031 4.61518 16.7015 3.75768 16.5865C2.92018 16.474 2.43685 16.2623 2.08435 15.9098C1.73185 15.5573 1.52018 15.074 1.40768 14.2356C1.29268 13.3798 1.29102 12.2506 1.29102 10.6615V8.99479Z" fill="currentColor"/>
                                        </svg>
                                        {{ $activity->datePublication->translatedFormat('d M Y') }}
                                    </div>
                                    @endif
                                </div>
                                <h2 class="card-blog-heading heading text-22">
                                    <a href="{{ route('front.activities.show', $activity) }}" class="heading text-22">
                                        {{ $activity->titre }}
                                    </a>
                                </h2>
                            </div>
                            <a class="card-blog-bottom" href="{{ route('front.activities.show', $activity) }}" aria-label="{{ $activity->titre }}">
                                <span class="blog-tag subheading subheading-bg text-16 fw-500">Activité</span>
                                <div class="media">
                                    <img
                                        src="{{ $activity->coverImage ? Storage::url($activity->coverImage->image_path) : asset('front-assets/consulo/img/blog/1.jpg') }}"
                                        alt="{{ $activity->titre }}"
                                        width="1000"
                                        height="707"
                                        loading="lazy"
                                    >
                                </div>
                                <div class="buttons">
                                    <div class="button button--primary">
                                        Lire la suite
                                        <svg viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.16668 0.833333C2.16668 0.61232 2.25448 0.400358 2.41076 0.244078C2.56704 0.0877975 2.779 0 3.00001 0H9.66668C9.88769 0 10.0997 0.0877975 10.2559 0.244078C10.4122 0.400358 10.5 0.61232 10.5 0.833333V7.5C10.5 7.72101 10.4122 7.93297 10.2559 8.08926C10.0997 8.24554 9.88769 8.33333 9.66668 8.33333C9.44567 8.33333 9.2337 8.24554 9.07742 8.08926C8.92114 7.93297 8.83335 7.72101 8.83335 7.5V2.845L1.92251 9.75583C1.76535 9.90763 1.55484 9.99163 1.33635 9.98973C1.11785 9.98783 0.908839 9.90019 0.754332 9.74568C0.599825 9.59118 0.512184 9.38216 0.510285 9.16367C0.508387 8.94517 0.592382 8.73467 0.744181 8.5775L7.65501 1.66667H3.00001C2.779 1.66667 2.56704 1.57887 2.41076 1.42259C2.25448 1.26631 2.16668 1.05435 2.16668 0.833333Z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>

            <div class="buttons buttons-discover text-center" data-aos="fade-up">
                <a href="{{ route('front.activities.index') }}" class="button button--secondary">
                    Voir toutes les activités
                    <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" width="20" height="20">
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
         FAQ / QUESTIONS
    ======================================================== --}}
    <div class="faq section-padding" style="margin-top: 30px;">
        <div class="container">
            <div class="row faq-row">
                <div class="col-lg-6 col-12">
                    <div class="section-headings">
                        <div class="subheading text-20 subheading-bg" data-aos="fade-up">
                            <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <g clip-path="url(#clip-faq-a)">
                                    <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="CurrentColor"/>
                                </g>
                                <defs><clipPath id="clip-faq-a"><rect width="14" height="14" fill="CurrentColor"/></clipPath></defs>
                            </svg>
                            <span>Questions</span>
                            <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <g clip-path="url(#clip-faq-b)">
                                    <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="CurrentColor"/>
                                </g>
                                <defs><clipPath id="clip-faq-b"><rect width="14" height="14" fill="CurrentColor"/></clipPath></defs>
                            </svg>
                        </div>
                        <h2 class="heading text-50" data-aos="fade-up" data-aos-delay="50">
                            Des questions ? Voici quelques réponses
                        </h2>
                        <div class="text text-18" data-aos="fade-up" data-aos-delay="80">
                            Vous souhaitez en savoir plus sur le programme EYWEP, les conditions de participation ou les activités proposées ? Retrouvez ci-dessous les questions les plus fréquentes.
                        </div>
                        <div class="buttons" data-aos="fade-up" data-aos-delay="100">
                            <a href="{{ route('front.contact') }}" class="button button--primary" aria-label="Poser votre question">
                                En Savoir plus
                                <span class="svg-wrapper">
                                    <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="CurrentColor"/>
                                    </svg>
                                </span>
                            </a>
                        </div>
                        <div class="image-absolute" data-aos="zoom-in">
                            <img src="{{ asset('front-assets/consulo/img/faq/question.png') }}" width="104" height="180" loading="lazy" alt="Question">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <faq-accordion>
                        <div class="accordion-list">
                            @forelse ($faqs as $faq)
                            <div class="accordion-block" data-aos="fade-up" @if(!$loop->first) data-aos-delay="{{ $loop->index * 50 }}" @endif>
                                <div class="accordion-opener heading text-22">
                                    {{ $faq->question }}
                                    <div class="svg-wrapper">
                                        <svg class="icon icon-24" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip-faq-chevron)">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.7083 15.7044C12.5208 15.8919 12.2665 15.9972 12.0013 15.9972C11.7362 15.9972 11.4818 15.8919 11.2943 15.7044L5.63732 10.0474C5.54181 9.95517 5.46563 9.84482 5.41322 9.72282C5.36081 9.60081 5.33322 9.46959 5.33207 9.33681C5.33092 9.20404 5.35622 9.07236 5.4065 8.94946C5.45678 8.82656 5.53103 8.71491 5.62492 8.62102C5.71882 8.52713 5.83047 8.45287 5.95337 8.40259C6.07626 8.35231 6.20794 8.32701 6.34072 8.32816C6.4735 8.32932 6.60472 8.3569 6.72672 8.40931C6.84873 8.46172 6.95907 8.5379 7.05132 8.63341L12.0013 13.5834L16.9513 8.63341C17.1399 8.45125 17.3925 8.35046 17.6547 8.35274C17.9169 8.35502 18.1677 8.46019 18.3531 8.64559C18.5385 8.831 18.6437 9.08182 18.646 9.34401C18.6483 9.60621 18.5475 9.85881 18.3653 10.0474L12.7083 15.7044Z" fill="CurrentColor"/>
                                            </g>
                                            <defs><clipPath id="clip-faq-chevron"><rect width="24" height="24" fill="CurrentColor"/></clipPath></defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="accordion-content">
                                    <div class="accordion-content-inner text text-18">
                                        {{ $faq->reponse }}
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text text-18" style="color:var(--color-foreground-subheading);">Aucune question disponible pour le moment.</p>
                            @endforelse
                        </div>
                    </faq-accordion>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection

@push('styles')
<style>
.activities-swiper .swiper-wrapper {
    align-items: stretch;
}
.activities-swiper .swiper-slide {
    height: auto;
    display: flex;
}
.activities-swiper .swiper-slide .card-blog {
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 100%;
}
.activities-swiper .swiper-slide .card-blog-top {
    flex: 1;
}
.activities-swiper .swiper-slide .card-blog-heading a {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
/* Titres articles section accueil */
.featured-blog .card-blog-heading a,
.featured-blog .card-blog-list-horizontal .card-blog-heading a {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var el = document.querySelector('.activities-swiper');
    if (!el || typeof Swiper === 'undefined') return;
    new Swiper('.activities-swiper', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 24,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        speed: 700,
        pagination: {
            el: '.activities-swiper .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.activities-swiper .swiper-button-next',
            prevEl: '.activities-swiper .swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 24,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 24,
            },
        },
    });
});
</script>
@endpush
