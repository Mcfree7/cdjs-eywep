@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp
@extends('front.layouts.app')

@push('styles')
<style>
.other-galleries-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
@media (max-width: 1199px) { .other-galleries-grid { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 767px)  { .other-galleries-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 479px)  { .other-galleries-grid { grid-template-columns: 1fr; } }

.gallery-home-card {
    display: flex;
    flex-direction: column;
    text-decoration: none;
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,.07);
    transition: transform .3s ease, box-shadow .3s ease;
}
.gallery-home-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 28px rgba(0,0,0,.14);
}
.gallery-home-cover {
    position: relative;
    aspect-ratio: 4/3;
    overflow: hidden;
    background: #e9ecef;
}
.gallery-home-cover > img,
.gallery-home-cover > video {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform .45s ease;
}
.gallery-home-card:hover .gallery-home-cover > img,
.gallery-home-card:hover .gallery-home-cover > video { transform: scale(1.07); }
.gallery-home-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    color: #adb5bd;
}
.gallery-home-badge {
    position: absolute; top: 10px; right: 10px;
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(0,0,0,.55); backdrop-filter: blur(6px);
    color: #fff; font-size: 12px; font-weight: 600;
    padding: 4px 10px; border-radius: 999px; line-height: 1;
}
.gallery-home-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,.75) 0%, rgba(0,0,0,.1) 55%, transparent 100%);
    display: flex; flex-direction: column;
    justify-content: flex-end; padding: 14px; gap: 8px;
    opacity: 0; transition: opacity .35s ease;
}
.gallery-home-card:hover .gallery-home-overlay { opacity: 1; }
.gallery-home-cta {
    display: inline-flex; align-items: center; gap: 6px;
    color: #fff; font-size: 13px; font-weight: 600;
    letter-spacing: .02em; text-transform: uppercase;
}
.gallery-home-info {
    display: flex; align-items: center;
    justify-content: space-between;
    padding: 10px 14px; gap: 8px;
}
.gallery-home-title {
    color: var(--color-foreground-heading);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.gallery-home-count {
    color: var(--color-foreground-subheading);
    white-space: nowrap; flex-shrink: 0;
}
</style>
@endpush

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
                <div class="section-headings mb-40">
                    <div class="subheading text-20 subheading-bg">
                        <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="currentColor"/>
                        </svg>
                        {{ __('app.pages.galleries') }}
                    </div>
                    <h2 class="heading text-40 fw-700">Autres galeries</h2>
                </div>
                <div class="other-galleries-grid">
                    @foreach ($otherGalleries as $other)
                    @php
                        $otherImages  = $other->medias->where('media_type', 'image');
                        $otherFirst   = $other->medias->first();
                        $otherIsVideo = $otherFirst && $otherFirst->media_type === 'video';
                        $otherCover   = $otherImages->first();
                        $otherTotal   = $other->medias->count();
                    @endphp
                    <a href="{{ route('front.galleries.show', $other) }}"
                       class="gallery-home-card"
                       aria-label="{{ $other->titre }}"
                       data-aos="fade-up"
                       data-aos-delay="{{ $loop->index * 60 }}">
                        <div class="gallery-home-cover">
                            @if ($otherIsVideo && $otherFirst)
                                <video src="{{ Storage::url($otherFirst->media_path) }}" muted preload="none"></video>
                            @elseif ($otherCover)
                                <img src="{{ Storage::url($otherCover->media_path) }}" alt="{{ $other->titre }}" loading="lazy">
                            @else
                                <div class="gallery-home-placeholder">
                                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 19V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2z" stroke="currentColor" stroke-width="1.5"/>
                                        <circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="m21 15-5-5L5 21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                </div>
                            @endif
                            <span class="gallery-home-badge">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 19V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2z" stroke="currentColor" stroke-width="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="2"/>
                                    <path d="m21 15-5-5L5 21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                {{ $otherTotal }}
                            </span>
                            <div class="gallery-home-overlay">
                                <span class="gallery-home-cta">
                                    {{ __('app.home.see_gallery') }}
                                    <svg width="13" height="13" viewBox="0 0 20 20" fill="none">
                                        <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="gallery-home-info">
                            <span class="gallery-home-title heading text-16 fw-600">{{ $other->titre }}</span>
                            <span class="gallery-home-count text text-13">{{ $otherTotal }} média{{ $otherTotal > 1 ? 's' : '' }}</span>
                        </div>
                    </a>
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
