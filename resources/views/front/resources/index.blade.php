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

            @php
                $fileColors = [
                    'pdf'  => ['bg' => '#dc3545', 'label' => 'PDF'],
                    'doc'  => ['bg' => '#0d6efd', 'label' => 'DOC'],
                    'docx' => ['bg' => '#0d6efd', 'label' => 'DOCX'],
                    'xls'  => ['bg' => '#198754', 'label' => 'XLS'],
                    'xlsx' => ['bg' => '#198754', 'label' => 'XLSX'],
                    'ppt'  => ['bg' => '#fd7e14', 'label' => 'PPT'],
                    'pptx' => ['bg' => '#fd7e14', 'label' => 'PPTX'],
                ];
            @endphp
            <div class="row g-4">
                @forelse ($resources as $resource)
                @php
                    $ft   = strtolower($resource->file_type ?? 'pdf');
                    $fc   = $fileColors[$ft] ?? ['bg' => '#6c757d', 'label' => strtoupper($ft)];
                @endphp
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="radius18 p-4 h-100 d-flex flex-column" style="border: 1px solid rgba(0,0,0,0.08); background:#fff; box-shadow: 0 2px 12px rgba(0,0,0,0.04);">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            {{-- Miniature type de fichier --}}
                            <div style="position:relative; width:40px; height:48px; flex-shrink:0;">
                                <svg viewBox="0 0 40 48" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:40px;height:48px;">
                                    <path d="M0 4C0 1.79 1.79 0 4 0H26L40 14V44C40 46.21 38.21 48 36 48H4C1.79 48 0 46.21 0 44V4Z" fill="{{ $fc['bg'] }}"/>
                                    <path d="M26 0L40 14H30C27.79 14 26 12.21 26 10V0Z" fill="rgba(0,0,0,0.22)"/>
                                </svg>
                                <span style="position:absolute;bottom:7px;left:0;right:0;text-align:center;color:#fff;font-weight:700;font-size:9px;letter-spacing:.04em;line-height:1;">{{ $fc['label'] }}</span>
                            </div>
                            <span class="text text-14 text-muted">
                                {{ $resource->datePublication ? $resource->datePublication->format('d/m/Y') : '' }}
                            </span>
                        </div>
                        <h2 class="heading text-20 fw-700 mb-3">
                            <a href="{{ route('front.resources.show', $resource) }}" class="link">
                                {{ $resource->translatedTitre() }}
                            </a>
                        </h2>
                        <p class="text text-18 flex-grow-1 mb-4">
                            {{ Str::limit(strip_tags($resource->translatedDescription()), 120) }}
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
