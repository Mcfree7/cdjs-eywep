@php
    use Illuminate\Support\Str;
@endphp
@extends('front.layouts.app')

@section('title', __('app.titles.resources') . ' - ' . ($settings->company_name ?? 'EYWEP'))
@section('description', 'Téléchargez les ressources et documents mis à disposition par ' . ($settings->company_name ?? 'EYWEP'))

@section('content')
<main>

    @include('front.partials.page-banner', ['bannerTitle' => __('app.pages.resources')])

    <section class="mt-100 section-padding">
        <div class="container">

            <div class="row g-4">
                @forelse ($resources as $resource)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="radius18 p-4 h-100 d-flex flex-column" style="border: 1px solid rgba(0,0,0,0.08); background:#fff; box-shadow: 0 2px 12px rgba(0,0,0,0.04);">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color: var(--color-primary, #1c2539);">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                            </svg>
                            <span class="text text-14 text-muted">
                                {{ $resource->datePublication ? $resource->datePublication->format('d/m/Y') : '' }}
                            </span>
                        </div>
                        <h2 class="heading text-20 fw-700 mb-3">
                            <a href="{{ route('front.resources.show', $resource) }}" class="link">
                                {{ $resource->titre }}
                            </a>
                        </h2>
                        <p class="text text-18 flex-grow-1 mb-4">
                            {{ Str::limit(strip_tags($resource->description), 120) }}
                        </p>
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('front.resources.show', $resource) }}" class="button button--secondary" style="font-size:14px; padding: 8px 16px;">
                                Voir le détail
                            </a>
                            <a href="{{ route('front.resources.download', $resource) }}" class="button button--primary" style="font-size:14px; padding: 8px 16px;">
                                Télécharger
                                <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text text-18 text-muted">Aucune ressource disponible pour le moment.</p>
                    <a href="{{ route('front.home') }}" class="button button--secondary mt-3">Retour à l'accueil</a>
                </div>
                @endforelse
            </div>

            @if ($resources->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $resources->links() }}
            </div>
            @endif

        </div>
    </section>

</main>
@endsection
