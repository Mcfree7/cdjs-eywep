@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp
@extends('front.layouts.app')

@section('title', 'Projets - ' . ($settings->company_name ?? 'EYWEP'))
@section('description', 'Découvrez tous les projets de ' . ($settings->company_name ?? 'EYWEP') . ' et postulez en ligne.')

@section('content')
<main>

    @include('front.partials.page-banner', ['bannerTitle' => 'Projets'])

    <div class="page-projects mt-100 section-padding">
        <div class="container">

            @forelse ($projects as $project)
            @php
                $statutLabel = match($project->statut) {
                    'ouvert' => 'Ouvert',
                    'ferme'  => 'Fermé',
                    default  => 'Archivé',
                };
            @endphp

            {{-- On utilise un wrapper div pour les cartes --}}
            @if ($loop->first)
            <div class="row product-grid">
            @endif

                <div class="col-12 col-sm-6 col-lg-4 col-xl-3" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                    <a
                        class="card-project radius18"
                        aria-label="{{ $project->titre }}"
                        href="{{ route('front.projects.show', $project) }}"
                    >
                        <img
                            src="{{ $project->coverImage ? Storage::url($project->coverImage->image_path) : asset('front-assets/consulo/img/project/card/' . (($loop->index % 8) + 1) . '.jpg') }}"
                            alt="{{ $project->titre }}"
                            width="645"
                            height="690"
                            loading="lazy"
                        >
                        <div class="card-project-content-absolute">
                            <div class="card-project-content">
                                <h2 class="heading text-24">{{ $project->titre }}</h2>
                                <p class="text text-16">
                                    {{ $statutLabel }}{{ $project->candidatures_count ? ' · ' . $project->candidatures_count . ' candidature' . ($project->candidatures_count > 1 ? 's' : '') : '' }}
                                </p>
                                @if ($project->statut === 'ouvert')
                                <span
                                    onclick="event.preventDefault(); event.stopPropagation(); window.location='{{ route('front.projects.show', $project) }}#candidature-form';"
                                    class="button button--primary mt-2"
                                    style="font-size:13px; padding: 8px 18px; display:inline-flex;"
                                    role="button"
                                    aria-label="Postuler pour {{ $project->titre }}"
                                >
                                    Postuler
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" style="margin-left:6px;">
                                        <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                                    </svg>
                                </span>
                                @endif
                            </div>
                        </div>
                        <span class="svg-wrapper icon-project-link">
                            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="32" cy="32" r="32" fill="white"/>
                                <path d="M26.1667 39C25.8167 39 25.5833 38.8833 25.35 38.65C24.8833 38.1833 24.8833 37.4833 25.35 37.0167L37.0167 25.35C37.4833 24.8833 38.1833 24.8833 38.65 25.35C39.1167 25.8167 39.1167 26.5167 38.65 26.9833L26.9833 38.65C26.75 38.8833 26.5167 39 26.1667 39Z" fill="#20282D"/>
                                <path d="M37.8332 37.8333C37.1332 37.8333 36.6665 37.3667 36.6665 36.6667V27.3333H27.3332C26.6332 27.3333 26.1665 26.8667 26.1665 26.1667C26.1665 25.4667 26.6332 25 27.3332 25H37.8332C38.5332 25 38.9998 25.4667 38.9998 26.1667V36.6667C38.9998 37.3667 38.5332 37.8333 37.8332 37.8333Z" fill="#20282D"/>
                            </svg>
                        </span>
                    </a>
                </div>

            @if ($loop->last)
            </div>
            @endif

            @empty
            <div class="text-center py-5">
                <p class="text text-18" style="color: var(--color-foreground-subheading);">Aucun projet disponible pour le moment.</p>
                <a href="{{ route('front.home') }}" class="button button--secondary mt-3">Retour à l'accueil</a>
            </div>
            @endforelse

            @if ($projects->hasPages())
            <div class="d-flex justify-content-center mt-5 pb-5">
                {{ $projects->links() }}
            </div>
            @endif

        </div>
    </div>

</main>
@endsection
