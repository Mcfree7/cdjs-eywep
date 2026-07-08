@php
    use Illuminate\Support\Str;
    $fileColors = [
        'pdf'  => ['bg' => '#dc3545', 'label' => 'PDF'],
        'doc'  => ['bg' => '#0d6efd', 'label' => 'DOC'],
        'docx' => ['bg' => '#0d6efd', 'label' => 'DOCX'],
        'xls'  => ['bg' => '#198754', 'label' => 'XLS'],
        'xlsx' => ['bg' => '#198754', 'label' => 'XLSX'],
        'ppt'  => ['bg' => '#fd7e14', 'label' => 'PPT'],
        'pptx' => ['bg' => '#fd7e14', 'label' => 'PPTX'],
    ];
    $ft = strtolower($resourceItem->file_type ?? 'pdf');
    $fc = $fileColors[$ft] ?? ['bg' => '#6c757d', 'label' => strtoupper($ft)];
@endphp
@extends('front.layouts.app')

@section('title', $resourceItem->translatedTitre() . ' - ' . ($settings->company_name ?? 'EYWEP'))
@section('description', Str::limit(strip_tags($resourceItem->translatedDescription()), 160))

@section('content')
<main>

    @include('front.partials.page-banner', [
        'bannerTitle'      => $resourceItem->translatedTitre(),
        'breadcrumbParent' => ['label' => 'Ressources', 'url' => route('front.resources.index')],
    ])

    <section class="page-project-details mt-100 section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9">

                    {{-- Resource info box --}}
                    <div class="sidebar-widget radius18 p-5 mb-5 d-flex flex-column flex-md-row align-items-md-center gap-4" style="border: 1px solid rgba(0,0,0,0.08); background: #fff;">
                        <div class="flex-shrink-0 text-center">
                            <div style="position:relative; width:64px; height:76px; display:inline-block;">
                                <svg viewBox="0 0 64 76" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:64px;height:76px;">
                                    <path d="M0 6C0 2.69 2.69 0 6 0H42L64 22V70C64 73.31 61.31 76 58 76H6C2.69 76 0 73.31 0 70V6Z" fill="{{ $fc['bg'] }}"/>
                                    <path d="M42 0L64 22H48C44.69 22 42 19.31 42 16V0Z" fill="rgba(0,0,0,0.22)"/>
                                </svg>
                                <span style="position:absolute;bottom:12px;left:0;right:0;text-align:center;color:#fff;font-weight:700;font-size:13px;letter-spacing:.05em;line-height:1;">{{ $fc['label'] }}</span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h1 class="heading text-40 fw-700 mb-2">{{ $resourceItem->translatedTitre() }}</h1>
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
                            @if ($resourceItem->file_titre)
                            <p class="text text-15 fw-600 mb-2">{{ $resourceItem->file_titre }}</p>
                            @endif
                            <a href="{{ route('front.resources.download', $resourceItem) }}" class="button button--primary">
                                {{ __('app.btn.download') }}
                                <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="text text-18 article-body mb-5">
                        {!! $resourceItem->translatedDescription() !!}
                    </div>

                    {{-- Documents supplémentaires --}}
                    @if ($resourceItem->files->isNotEmpty())
                    <div class="mb-5">
                        <h2 class="heading text-24 fw-700 mb-4">Documents supplémentaires</h2>
                        <div class="d-flex flex-column gap-3">
                            @foreach ($resourceItem->files as $extraFile)
                            @php
                                $eft = strtolower($extraFile->file_type);
                                $efc = $fileColors[$eft] ?? ['bg' => '#6c757d', 'label' => strtoupper($eft)];
                            @endphp
                            <a href="{{ route('front.resources.download.file', [$resourceItem, $extraFile]) }}"
                               class="d-flex align-items-center gap-3 radius18 p-4 text-decoration-none"
                               style="border: 1px solid rgba(0,0,0,0.08); background:#fff; transition: box-shadow .2s;"
                               onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                                <div style="position:relative; width:40px; height:48px; flex-shrink:0;">
                                    <svg viewBox="0 0 40 48" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:40px;height:48px;">
                                        <path d="M0 4C0 1.79 1.79 0 4 0H26L40 14V44C40 46.21 38.21 48 36 48H4C1.79 48 0 46.21 0 44V4Z" fill="{{ $efc['bg'] }}"/>
                                        <path d="M26 0L40 14H30C27.79 14 26 12.21 26 10V0Z" fill="rgba(0,0,0,0.22)"/>
                                    </svg>
                                    <span style="position:absolute;bottom:7px;left:0;right:0;text-align:center;color:#fff;font-weight:700;font-size:8px;letter-spacing:.04em;line-height:1;">{{ $efc['label'] }}</span>
                                </div>
                                <span class="text text-16 fw-600" style="color: var(--color-foreground);">{{ $extraFile->titre }}</span>
                                <svg class="ms-auto flex-shrink-0" width="20" height="20" viewBox="0 0 20 20" fill="none" style="color: var(--color-primary, #1c2539);">
                                    <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                                </svg>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Related resources --}}
                    @if (isset($relatedResources) && $relatedResources->isNotEmpty())
                    <div class="mt-5 pt-5" style="border-top: 1px solid rgba(0,0,0,0.08);">
                        <h2 class="heading text-30 fw-700 mb-4">Ressources similaires</h2>
                        <div class="row g-4">
                            @foreach ($relatedResources as $related)
                            @php
                                $rft = strtolower($related->file_type ?? 'pdf');
                                $rfc = $fileColors[$rft] ?? ['bg' => '#6c757d', 'label' => strtoupper($rft)];
                            @endphp
                            <div class="col-12 col-md-6">
                                <div class="radius18 p-4 d-flex gap-3 align-items-start" style="border: 1px solid rgba(0,0,0,0.08); background:#fff;">
                                    <div style="position:relative; width:32px; height:38px; flex-shrink:0;">
                                        <svg viewBox="0 0 32 38" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:32px;height:38px;">
                                            <path d="M0 3C0 1.34 1.34 0 3 0H21L32 11V35C32 36.66 30.66 38 29 38H3C1.34 38 0 36.66 0 35V3Z" fill="{{ $rfc['bg'] }}"/>
                                            <path d="M21 0L32 11H24C22.34 11 21 9.66 21 8V0Z" fill="rgba(0,0,0,0.22)"/>
                                        </svg>
                                        <span style="position:absolute;bottom:5px;left:0;right:0;text-align:center;color:#fff;font-weight:700;font-size:7px;letter-spacing:.03em;line-height:1;">{{ $rfc['label'] }}</span>
                                    </div>
                                    <div>
                                        <a href="{{ route('front.resources.show', $related) }}" class="heading text-18 fw-600 link d-block mb-1">
                                            {{ $related->translatedTitre() }}
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
