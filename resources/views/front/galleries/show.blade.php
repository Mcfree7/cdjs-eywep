@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp
@extends('front.layouts.app')

@section('title', $gallery->titre . ' - ' . ($settings->company_name ?? 'EYWEP'))
@section('description', Str::limit(strip_tags($gallery->description ?? ''), 160))

@section('content')
<main>

    @include('front.partials.page-banner', [
        'bannerTitle'      => $gallery->titre,
        'breadcrumbParent' => ['label' => 'Galeries', 'url' => route('front.galleries.index')],
    ])

    <section class="page-project-details mt-100 section-padding">
        <div class="container">

            {{-- Gallery header --}}
            <div class="row justify-content-center mb-5">
                <div class="col-12 col-lg-8 text-center">
                    <h1 class="heading text-50 fw-700 mb-3">{{ $gallery->titre }}</h1>
                    @if ($gallery->description)
                    <p class="text text-18">{{ $gallery->description }}</p>
                    @endif
                    <span class="text text-16 text-muted">{{ $gallery->medias->count() }} média(s)</span>
                </div>
            </div>

            {{-- Media grid --}}
            @if ($gallery->medias->isNotEmpty())
            <div class="row g-4">
                @foreach ($gallery->medias as $media)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="radius18 overflow-hidden" style="aspect-ratio: 4/3; background:#f0f0f0;">
                        @if ($media->media_type === 'video')
                            <video
                                src="{{ Storage::url($media->media_path) }}"
                                controls
                                preload="metadata"
                                class="w-100 h-100 radius18"
                                style="object-fit: cover; display: block;"
                            >
                                Votre navigateur ne supporte pas la lecture vidéo.
                            </video>
                        @else
                            <a
                                href="{{ Storage::url($media->media_path) }}"
                                target="_blank"
                                rel="noopener"
                                aria-label="Voir l'image en taille réelle"
                            >
                                <img
                                    src="{{ Storage::url($media->media_path) }}"
                                    alt="{{ $gallery->titre }}"
                                    loading="lazy"
                                    class="w-100 h-100 radius18"
                                    style="object-fit: cover; display: block; transition: transform 0.3s;"
                                    onmouseover="this.style.transform='scale(1.03)'"
                                    onmouseout="this.style.transform='scale(1)'"
                                >
                            </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-5">
                <p class="text text-18 text-muted">Cette galerie ne contient pas encore de médias.</p>
            </div>
            @endif

            {{-- Other galleries --}}
            @if (isset($otherGalleries) && $otherGalleries->isNotEmpty())
            <div class="mt-100">
                <div class="section-headings mb-5">
                    <h2 class="heading text-40 fw-700">Autres galeries</h2>
                </div>
                <div class="product-grid">
                    @foreach ($otherGalleries as $other)
                    @php
                        $otherFirstMedia = $other->medias->first();
                        $otherIsVideo = $otherFirstMedia && $otherFirstMedia->media_type === 'video';
                        $otherSrc = $otherFirstMedia ? Storage::url($otherFirstMedia->media_path) : asset('front-assets/consulo/img/project/card/1.jpg');
                    @endphp
                    <div class="card-project radius18">
                        <div class="card-project-img radius18">
                            @if ($otherIsVideo)
                                <video src="{{ $otherSrc }}" muted preload="none" class="radius18" style="width:100%;height:100%;object-fit:cover;"></video>
                            @else
                                <img src="{{ $otherSrc }}" alt="{{ $other->titre }}" loading="lazy" class="radius18">
                            @endif
                        </div>
                        <div class="card-project-overlay radius18">
                            <div class="card-project-content">
                                <h3 class="heading text-20 fw-700 text-white mb-1">{{ $other->titre }}</h3>
                                <span class="badge bg-white text-dark">{{ $other->medias->count() }} média(s)</span>
                            </div>
                            <a href="{{ route('front.galleries.show', $other) }}" class="card-project-link" aria-label="Voir {{ $other->titre }}">
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
            </div>
            @endif

            <div class="mt-5">
                <a href="{{ route('front.galleries.index') }}" class="button button--secondary">
                    <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none" style="transform:rotate(180deg);">
                        <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                    </svg>
                    Toutes les galeries
                </a>
            </div>

        </div>
    </section>

</main>
@endsection
