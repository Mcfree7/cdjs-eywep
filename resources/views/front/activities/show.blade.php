@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp
@extends('front.layouts.app')

@section('title', $activity->titre . ' - ' . ($settings->company_name ?? 'EYWEP'))
@section('description', Str::limit(strip_tags($activity->description), 160))


@section('content')
<main>

    @include('front.partials.page-banner', [
        'bannerTitle'      => $activity->titre,
        'breadcrumbParent' => ['label' => 'Activités', 'url' => route('front.activities.index')],
    ])

    <section class="page-project-details mt-100 section-padding">
        <div class="container">
            <div class="row g-5">

                {{-- Main content --}}
                <div class="col-12 col-lg-8">

                    @if ($activity->images->count() > 1)
                    {{-- Slider multi-images --}}
                    <div class="activity-images-swiper swiper radius18 mb-5">
                        <div class="swiper-wrapper">
                            @foreach ($activity->images as $img)
                            <div class="swiper-slide">
                                <div class="card-blog-list-media radius18">
                                    <div class="media">
                                        <img
                                            src="{{ Storage::url($img->image_path) }}"
                                            alt="{{ $activity->titre }}"
                                            width="1000"
                                            height="707"
                                            loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                        >
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    @elseif ($activity->coverImage)
                    {{-- Image unique --}}
                    <div class="card-blog-list-media radius18 mb-5">
                        <div class="media">
                            <img
                                src="{{ Storage::url($activity->coverImage->image_path) }}"
                                alt="{{ $activity->titre }}"
                                width="1000"
                                height="707"
                                loading="eager"
                            >
                        </div>
                    </div>
                    @endif

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <span class="text text-14 text-muted">
                            {{ $activity->datePublication ? $activity->datePublication->format('d/m/Y') : '' }}
                        </span>
                    </div>

                    <h1 class="heading text-50 fw-700 mb-4">{{ $activity->titre }}</h1>

                    <div class="text text-18 article-body mb-5">
                        {!! $activity->description !!}
                    </div>

                </div>

                {{-- Sidebar --}}
                <div class="col-12 col-lg-4">
                    @if (isset($relatedActivities) && $relatedActivities->isNotEmpty())
                    <div class="sidebar-widget radius18 p-4" style="border: 1px solid rgba(0,0,0,0.08); background:#fff;">
                        <h3 class="heading text-22 fw-700 mb-4">Activités similaires</h3>
                        <ul class="list-unstyled">
                            @foreach ($relatedActivities as $related)
                            <li class="d-flex gap-3 align-items-start mb-4 pb-4" style="{{ !$loop->last ? 'border-bottom: 1px solid rgba(0,0,0,0.08);' : '' }}">
                                @if ($related->coverImage)
                                <a href="{{ route('front.activities.show', $related) }}" class="flex-shrink-0">
                                    <img
                                        src="{{ Storage::url($related->coverImage->image_path) }}"
                                        alt="{{ $related->titre }}"
                                        class="radius18"
                                        style="width:80px; height:60px; object-fit:cover;"
                                        loading="lazy"
                                    >
                                </a>
                                @endif
                                <div>
                                    <span class="text text-12 text-muted d-block mb-1">
                                        {{ $related->datePublication ? $related->datePublication->format('d/m/Y') : '' }}
                                    </span>
                                    <a href="{{ route('front.activities.show', $related) }}" class="heading text-16 fw-600 link d-block" title="{{ $related->titre }}">
                                        {{ Str::limit($related->titre, 60) }}
                                    </a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('front.activities.index') }}" class="button button--secondary w-100 justify-content-center">
                            <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none" style="transform:rotate(180deg);">
                                <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                            </svg>
                            Toutes les activités
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var el = document.querySelector('.activity-images-swiper');
    if (!el || typeof Swiper === 'undefined') return;
    new Swiper('.activity-images-swiper', {
        loop: true,
        slidesPerView: 1,
        effect: 'fade',
        fadeEffect: { crossFade: true },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        speed: 800,
        pagination: { el: '.activity-images-swiper .swiper-pagination', clickable: true },
        navigation: {
            nextEl: '.activity-images-swiper .swiper-button-next',
            prevEl: '.activity-images-swiper .swiper-button-prev',
        },
    });
});
</script>
@endpush
