@extends('admin.layouts.admin')

@push('styles')
    <style>
        .galleries-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .galleries-title h3 {
            font-family: inherit; /* même police que le tableau */
            font-weight: 600; /* proche des th des tables */
            font-size: 1.25rem; /* taille harmonisée */
            color: #212529;
        }

        .galleries-subtitle {
            font-family: inherit;
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="galleries-header d-flex justify-content-between align-items-center flex-wrap">

            <!-- LEFT -->
            <div class="galleries-title">
                <h3 class="mb-0">Détails de la galerie</h3>
                <span class="galleries-subtitle">Consultation d'une galerie</span>
            </div>

            <!-- RIGHT -->
            <div>
                <a href="{{ route('galleries.index') }}" class="btn btn-secondary shadow-sm">
                    Retour
                </a>
            </div>

        </div>

        <!-- Breadcrumb -->
        <div class="row mt-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('galleries.index') }}">Galeries</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détails</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">{{ $gallery->titre }}</h3>
                    <div class="d-flex gap-2">
                        <a href="{{ route('galleries.edit', $gallery) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Modifier
                        </a>
                        <a href="{{ route('galleries.index') }}" class="btn btn-secondary btn-sm">Retour</a>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">{{ $gallery->medias->count() }} media(s) enregistre(s)</p>

                    <div class="row g-3">
                        @forelse ($gallery->medias as $media)
                            @php
                                $mediaUrl = \Illuminate\Support\Str::startsWith($media->media_path, ['http://', 'https://'])
                                    ? $media->media_path
                                    : asset('storage/' . $media->media_path);
                            @endphp
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="card h-100">
                                    @if ($media->media_type === 'video')
                                        <video class="card-img-top" style="height: 220px; object-fit: cover;" controls muted playsinline>
                                            <source src="{{ $mediaUrl }}">
                                        </video>
                                    @else
                                        <img src="{{ $mediaUrl }}" alt="Media galerie {{ $media->id }}" class="card-img-top" style="height: 220px; object-fit: cover;">
                                    @endif
                                    <div class="card-body p-2">
                                        <span class="badge {{ $media->media_type === 'video' ? 'text-bg-dark' : 'text-bg-primary' }}">
                                            {{ $media->media_type === 'video' ? 'Video' : 'Image' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-secondary mb-0">Aucun media pour cette galerie.</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
