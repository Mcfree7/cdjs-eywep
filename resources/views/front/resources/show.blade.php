@php
    use Illuminate\Support\Str;
@endphp
@extends('front.layouts.app')

@section('title', $resourceItem->titre . ' - ' . ($settings->company_name ?? 'EYWEP'))
@section('description', Str::limit(strip_tags($resourceItem->description), 160))

@section('content')
<main>

    @include('front.partials.page-banner', [
        'bannerTitle'      => $resourceItem->titre,
        'breadcrumbParent' => ['label' => 'Ressources', 'url' => route('front.resources.index')],
    ])

    <section class="page-project-details mt-100 section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9">

                    {{-- Resource info box --}}
                    <div class="sidebar-widget radius18 p-5 mb-5 d-flex flex-column flex-md-row align-items-md-center gap-4" style="border: 1px solid rgba(0,0,0,0.08); background: #fff;">
                        <div class="flex-shrink-0 text-center" style="font-size: 64px; line-height:1;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1" style="color: var(--color-primary, #1c2539);">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                            </svg>
                        </div>
                        <div class="flex-grow-1">
                            <h1 class="heading text-40 fw-700 mb-2">{{ $resourceItem->titre }}</h1>
                            <div class="d-flex flex-wrap gap-3 align-items-center mb-3">
                                @if ($resourceItem->datePublication)
                                <span class="text text-16 text-muted">
                                    Publié le {{ $resourceItem->datePublication->format('d/m/Y') }}
                                </span>
                                @endif
                                @if ($resourceItem->file_name)
                                <span class="badge" style="background: rgba(0,0,0,0.06); color: inherit; font-size:13px; font-weight:500;">
                                    {{ $resourceItem->file_name }}
                                </span>
                                @endif
                            </div>
                            <a href="{{ route('front.resources.download', $resourceItem) }}" class="button button--primary">
                                Télécharger le fichier
                                <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="text text-18 article-body mb-5">
                        {!! $resourceItem->description !!}
                    </div>

                    {{-- Related resources --}}
                    @if (isset($relatedResources) && $relatedResources->isNotEmpty())
                    <div class="mt-5 pt-5" style="border-top: 1px solid rgba(0,0,0,0.08);">
                        <h2 class="heading text-30 fw-700 mb-4">Ressources similaires</h2>
                        <div class="row g-4">
                            @foreach ($relatedResources as $related)
                            <div class="col-12 col-md-6">
                                <div class="radius18 p-4 d-flex gap-3 align-items-start" style="border: 1px solid rgba(0,0,0,0.08); background:#fff;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="flex-shrink-0" style="color: var(--color-primary, #1c2539);">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                    <div>
                                        <a href="{{ route('front.resources.show', $related) }}" class="heading text-18 fw-600 link d-block mb-1">
                                            {{ $related->titre }}
                                        </a>
                                        <span class="text text-14 text-muted d-block mb-2">
                                            {{ $related->datePublication ? $related->datePublication->format('d/m/Y') : '' }}
                                        </span>
                                        <a href="{{ route('front.resources.download', $related) }}" class="text text-14 link" style="color: var(--color-primary, #1c2539);">
                                            Télécharger
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="mt-5">
                        <a href="{{ route('front.resources.index') }}" class="button button--secondary">
                            <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none" style="transform:rotate(180deg);">
                                <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                            </svg>
                            Toutes les ressources
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>
@endsection
