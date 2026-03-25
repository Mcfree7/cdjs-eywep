@extends('admin.layouts.admin')

@push('styles')
    <style>
        .resources-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .resources-title h3 {
            font-family: inherit;
            font-weight: 600;
            font-size: 1.25rem;
            color: #212529;
        }

        .resources-subtitle {
            font-family: inherit;
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="resources-header d-flex justify-content-between align-items-center flex-wrap">

            <!-- LEFT -->
            <div class="resources-title">
                <h3 class="mb-0">Détails de la ressource</h3>
                <span class="resources-subtitle">Consultation d'une ressource</span>
            </div>

            <!-- RIGHT -->
            <div>
                <a href="{{ route('admin.resources.index') }}" class="btn btn-secondary shadow-sm">
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
                    <li class="breadcrumb-item"><a href="{{ route('admin.resources.index') }}">Ressources</a></li>
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
                    <h3 class="card-title mb-0">{{ $resourceItem->titre }}</h3>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.resources.edit', $resourceItem) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Modifier
                        </a>
                        <a href="{{ route('admin.resources.index') }}" class="btn btn-secondary btn-sm">Retour</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <p class="text-muted mb-2">Categorie : <span class="fw-semibold text-dark">{{ ucfirst($resourceItem->categorie) }}</span></p>
                            <p class="text-muted mb-4">Date de publication : {{ optional($resourceItem->datePublication)->format('d/m/Y') ?? 'Non definie' }}</p>
                            <div>{{ $resourceItem->description ?: 'Aucune description renseignee.' }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded-4 p-4 bg-light h-100">
                                <div class="fw-semibold mb-2">Fichier</div>
                                <p class="mb-2">{{ $resourceItem->file_name }}</p>
                                <p class="text-muted mb-3">Type : {{ strtoupper($resourceItem->file_type) }}</p>
                                <a href="{{ asset('storage/' . $resourceItem->file_path) }}" target="_blank" class="btn btn-primary w-100">
                                    Ouvrir le fichier
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
