@extends('admin.layouts.admin')

@push('styles')
    <style>
        .stories-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .stories-title h3 {
            font-family: inherit;
            font-weight: 600;
            font-size: 1.25rem;
            color: #212529;
        }

        .stories-subtitle {
            font-family: inherit;
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="stories-header d-flex justify-content-between align-items-center flex-wrap">

            <!-- LEFT -->
            <div class="stories-title">
                <h3 class="mb-0">Détails de la success story</h3>
                <span class="stories-subtitle">Consultation d'une success story</span>
            </div>

            <!-- RIGHT -->
            <div>
                <a href="{{ route('success-stories.index') }}" class="btn btn-secondary shadow-sm">
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
                    <li class="breadcrumb-item"><a href="{{ route('success-stories.index') }}">Success Stories</a></li>
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
                    <h3 class="card-title mb-0">{{ $successStory->titre }}</h3>
                    <div class="d-flex gap-2">
                        <a href="{{ route('success-stories.edit', $successStory) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Modifier
                        </a>
                        <a href="{{ route('success-stories.index') }}" class="btn btn-secondary btn-sm">Retour</a>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Date de publication : {{ optional($successStory->datePublication)->format('d/m/Y') ?? 'Non definie' }}</p>

                    <div class="mb-4">
                        {!! $successStory->description !!}
                    </div>

                    <h5 class="mb-3">Galerie d'images</h5>
                    <div class="row g-3">
                        @forelse ($successStory->images as $image)
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Image success story {{ $image->id }}" class="card-img-top" style="height: 220px; object-fit: cover;">
                                    <div class="card-body p-2">
                                        @if ($successStory->imageId === $image->id)
                                            <span class="badge text-bg-primary">Image principale</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-secondary mb-0">Aucune image pour cette success story.</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
