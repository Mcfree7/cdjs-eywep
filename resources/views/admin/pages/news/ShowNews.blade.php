@extends('admin.layouts.admin')

@push('styles')
    <style>
        .news-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .news-title h3 {
            font-family: inherit;
            font-weight: 600;
            font-size: 1.25rem;
            color: #212529;
        }

        .news-subtitle {
            font-family: inherit;
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="news-header d-flex justify-content-between align-items-center flex-wrap">

            <!-- LEFT -->
            <div class="news-title">
                <h3 class="mb-0">Détails du breaking news</h3>
                <span class="news-subtitle">Consultation d'un breaking news</span>
            </div>

            <!-- RIGHT -->
            <div>
                <a href="{{ route('news.index') }}" class="btn btn-secondary shadow-sm">
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
                    <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Breaking News</a></li>
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
                    <h3 class="card-title mb-0">{{ $news->titre }}</h3>
                    <div class="d-flex gap-2">
                        <a href="{{ route('news.edit', $news) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Modifier
                        </a>
                        <a href="{{ route('news.index') }}" class="btn btn-secondary btn-sm">Retour</a>
                    </div>
                </div>
                <div class="card-body">
                    <p class="mb-3">
                        <span class="fw-semibold">Statut :</span>
                        <span class="badge {{ $news->status === 'actif' ? 'text-bg-success' : 'text-bg-secondary' }}">
                            {{ ucfirst($news->status) }}
                        </span>
                    </p>
                    <p class="mb-0">
                        <span class="fw-semibold">Titre affiche :</span>
                        {{ $news->titre }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
