@extends('admin.layouts.admin')

@push('styles')
    <style>
        .articles-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .articles-title h3 {
            font-family: inherit; /* même police que le tableau */
            font-weight: 600; /* proche des th des tables */
            font-size: 1.25rem; /* taille harmonisée */
            color: #212529;
        }

        .articles-subtitle {
            font-family: inherit;
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="articles-header d-flex justify-content-between align-items-center flex-wrap">

            <!-- LEFT -->
            <div class="articles-title">
                <h3 class="mb-0">Details de l'article</h3>
                <span class="articles-subtitle">Consultation d'un article</span>
            </div>

            <!-- RIGHT -->
            <div>
                <a href="{{ route('articles.index') }}" class="btn btn-secondary shadow-sm">
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
                    <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Articles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">{{ $article->titre }}</h3>
                    <div class="d-flex gap-2">
                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Modifier
                        </a>
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary btn-sm">Retour</a>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Date de publication : {{ optional($article->datePublication)->format('d/m/Y') ?? 'Non definie' }}</p>

                    <div class="mb-4">
                        {!! $article->description !!}
                    </div>

                    <h5 class="mb-3">Galerie d'images</h5>
                    <div class="row g-3">
                        @forelse ($article->images as $image)
                            @php
                                $imageUrl = \Illuminate\Support\Str::startsWith($image->image_path, ['http://', 'https://'])
                                    ? $image->image_path
                                    : asset('storage/' . $image->image_path);
                            @endphp
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img src="{{ $imageUrl }}" alt="Image article {{ $image->id }}" class="card-img-top" style="height: 220px; object-fit: cover;">
                                    <div class="card-body p-2">
                                        @if ($article->imageId === $image->id)
                                            <span class="badge text-bg-primary">Image principale</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-secondary mb-0">Aucune image pour cet article.</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
