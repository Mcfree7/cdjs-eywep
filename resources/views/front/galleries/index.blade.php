@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp
@extends('front.layouts.app')

@section('title', __('app.titles.galleries') . ' - ' . ($settings->company_name ?? 'EYWEP'))
@section('description', 'Parcourez les galeries photos et vidéos de ' . ($settings->company_name ?? 'EYWEP'))

@push('styles')
<style>
.gallery-home-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
@media (max-width: 1199px) {
    .gallery-home-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 767px) {
    .gallery-home-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 479px) {
    .gallery-home-grid { grid-template-columns: 1fr; }
}

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
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .45s ease;
}
.gallery-home-card:hover .gallery-home-cover > img,
.gallery-home-card:hover .gallery-home-cover > video {
    transform: scale(1.07);
}
.gallery-home-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #adb5bd;
}

.gallery-home-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: rgba(0,0,0,.55);
    backdrop-filter: blur(6px);
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 999px;
    line-height: 1;
}

.gallery-home-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,.78) 0%, rgba(0,0,0,.15) 55%, transparent 100%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 14px;
    gap: 10px;
    opacity: 0;
    transition: opacity .35s ease;
}
.gallery-home-card:hover .gallery-home-overlay {
    opacity: 1;
}

.gallery-home-previews {
    display: flex;
    gap: 6px;
}
.gallery-home-preview-thumb {
    flex: 1;
    aspect-ratio: 1;
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid rgba(255,255,255,.4);
}
.gallery-home-preview-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.gallery-home-preview-more {
    flex: 1;
    aspect-ratio: 1;
    border-radius: 8px;
    background: rgba(255,255,255,.2);
    border: 2px solid rgba(255,255,255,.4);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 13px;
    font-weight: 700;
}

.gallery-home-cta {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: .02em;
    text-transform: uppercase;
}

.gallery-home-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 14px;
    gap: 8px;
}
.gallery-home-title {
    color: var(--color-foreground-heading);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.gallery-home-count {
    color: var(--color-foreground-subheading);
    white-space: nowrap;
    flex-shrink: 0;
}
</style>
@endpush

@section('content')
<main>

    @include('front.partials.page-banner', ['bannerTitle' => __('app.pages.galleries')])

    <section class="section-padding">
        <div class="container">

            @forelse ($galleries as $gallery)
                @php
                    $images   = $gallery->medias->where('media_type', 'image');
                    $firstMedia = $gallery->medias->first();
                    $isVideo  = $firstMedia && $firstMedia->media_type === 'video';
                    $cover    = $images->first();
                    $previews = $images->skip(1)->take(3)->values();
                    $total    = $gallery->medias->count();
                @endphp

                @if ($loop->first)
                <div class="gallery-home-grid">
                @endif

                <a
                    href="{{ route('front.galleries.show', $gallery) }}"
                    class="gallery-home-card radius18"
                    aria-label="{{ $gallery->titre }}"
                    data-aos="fade-up"
                    data-aos-delay="{{ ($loop->index % 4) * 60 }}"
                >
                    <div class="gallery-home-cover">
                        @if ($isVideo && $firstMedia)
                            <video
                                src="{{ Storage::url($firstMedia->media_path) }}"
                                muted
                                preload="none"
                            ></video>
                        @elseif ($cover)
                            <img src="{{ Storage::url($cover->media_path) }}" alt="{{ $gallery->titre }}" loading="lazy">
                        @else
                            <div class="gallery-home-placeholder">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 19V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2z" stroke="currentColor" stroke-width="1.5"/>
                                    <circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="m21 15-5-5L5 21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </div>
                        @endif

                        <span class="gallery-home-badge">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                                <path d="M21 19V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2z" stroke="currentColor" stroke-width="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="2"/>
                                <path d="m21 15-5-5L5 21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            {{ $total }}
                        </span>

                        <div class="gallery-home-overlay">
                            @if ($previews->count())
                            <div class="gallery-home-previews">
                                @foreach ($previews as $preview)
                                <div class="gallery-home-preview-thumb">
                                    <img src="{{ Storage::url($preview->media_path) }}" alt="" loading="lazy">
                                </div>
                                @endforeach
                                @if ($total > 4)
                                <div class="gallery-home-preview-more">+{{ $total - 4 }}</div>
                                @endif
                            </div>
                            @endif
                            <span class="gallery-home-cta">
                                Voir la galerie
                                <svg width="14" height="14" viewBox="0 0 20 20" fill="none">
                                    <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="gallery-home-info">
                        <span class="gallery-home-title heading text-16 fw-600">{{ $gallery->titre }}</span>
                        <span class="gallery-home-count text text-13">{{ $total }} média{{ $total > 1 ? 's' : '' }}</span>
                    </div>
                </a>

                @if ($loop->last)
                </div>
                @endif

            @empty
                <div class="text-center py-5">
                    <p class="text text-18" style="color: var(--color-foreground-subheading);">Aucune galerie disponible pour le moment.</p>
                    <a href="{{ route('front.home') }}" class="button button--secondary mt-3">Retour à l'accueil</a>
                </div>
            @endforelse

            @if ($galleries->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $galleries->links() }}
            </div>
            @endif

        </div>
    </section>

</main>
@endsection
