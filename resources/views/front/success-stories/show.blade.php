@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp
@extends('front.layouts.app')

@section('title', $successStory->titre . ' - ' . ($settings->company_name ?? 'EYWEP'))
@section('description', Str::limit(strip_tags($successStory->description), 160))

@section('content')
<main>

    @include('front.partials.page-banner', [
        'bannerTitle'      => $successStory->titre,
        'breadcrumbParent' => ['label' => 'Témoignages', 'url' => route('front.success-stories.index')],
    ])

    <section class="page-project-details mt-100 section-padding">
        <div class="container">
            <div class="row g-5">

                {{-- Main content --}}
                <div class="col-12 col-lg-8">

                    @if ($successStory->coverImage)
                    <div class="mb-5">
                        <img
                            src="{{ Storage::url($successStory->coverImage->image_path) }}"
                            alt="{{ $successStory->titre }}"
                            class="img-fluid radius18 w-100"
                            style="max-height: 480px; object-fit: cover;"
                        >
                    </div>
                    @endif

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <span class="text text-14 text-muted">
                            {{ $successStory->datePublication ? $successStory->datePublication->format('d/m/Y') : '' }}
                        </span>
                    </div>

                    <h1 class="heading text-50 fw-700 mb-4">{{ $successStory->titre }}</h1>

                    <div class="text text-18 article-body mb-5">
                        {!! $successStory->description !!}
                    </div>

                </div>

                {{-- Sidebar --}}
                <div class="col-12 col-lg-4">
                    @if (isset($relatedStories) && $relatedStories->isNotEmpty())
                    <div class="sidebar-widget radius18 p-4" style="border: 1px solid rgba(0,0,0,0.08); background:#fff;">
                        <h3 class="heading text-22 fw-700 mb-4">Témoignages similaires</h3>
                        <ul class="list-unstyled">
                            @foreach ($relatedStories as $related)
                            <li class="d-flex gap-3 align-items-start mb-4 pb-4" style="{{ !$loop->last ? 'border-bottom: 1px solid rgba(0,0,0,0.08);' : '' }}">
                                @if ($related->coverImage)
                                <a href="{{ route('front.success-stories.show', $related) }}" class="flex-shrink-0">
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
                                    <a href="{{ route('front.success-stories.show', $related) }}" class="heading text-16 fw-600 link d-block">
                                        {{ $related->titre }}
                                    </a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('front.success-stories.index') }}" class="button button--secondary w-100 justify-content-center">
                            <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none" style="transform:rotate(180deg);">
                                <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                            </svg>
                            Tous les témoignages
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
@endsection
