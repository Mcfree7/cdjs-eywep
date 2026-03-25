@extends('admin.layouts.admin')

@push('styles')
    <style>
        .partners-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .partners-title h3 {
            font-family: inherit;
            font-weight: 600;
            font-size: 1.25rem;
            color: #212529;
        }

        .partners-subtitle {
            font-family: inherit;
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="partners-header d-flex justify-content-between align-items-center flex-wrap">

            <!-- LEFT -->
            <div class="partners-title">
                <h3 class="mb-0">Détails du partenaire</h3>
                <span class="partners-subtitle">Consultation d'un partenaire</span>
            </div>

            <!-- RIGHT -->
            <div>
                <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary shadow-sm">
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
                    <li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}">Partenaires</a></li>
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
                    <h3 class="card-title mb-0">{{ $partner->nom }}</h3>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Modifier
                        </a>
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary btn-sm">Retour</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->nom }}" style="max-width: 260px; max-height: 200px; object-fit: contain; background: #fff; border: 1px solid var(--bs-border-color); border-radius: 1.25rem; padding: 1.25rem;">
                        </div>
                        <div class="col-md-8">
                            <h4 class="mb-3">{{ $partner->nom }}</h4>
                            <p class="mb-0">
                                <span class="fw-semibold">Lien :</span>
                                @if ($partner->lien)
                                    <a href="{{ $partner->lien }}" target="_blank" rel="noopener noreferrer">{{ $partner->lien }}</a>
                                @else
                                    <span class="text-muted">Aucun lien renseigne</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
