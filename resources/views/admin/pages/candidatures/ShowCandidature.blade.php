@extends('admin.layouts.admin')

@push('styles')
    <style>
        .candidatures-header {
            background: #fff; padding: 1.2rem 1.5rem;
            border-radius: 1rem; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .candidatures-title h3 { font-family: inherit; font-weight: 600; font-size: 1.25rem; color: #212529; }
        .candidatures-subtitle { font-family: inherit; }

        .info-row { display: flex; gap: 0.5rem; padding: 0.6rem 0; border-bottom: 1px solid #f1f3f5; }
        .info-row:last-child { border-bottom: 0; }
        .info-label { font-size: 0.8rem; font-weight: 600; color: #6c757d; min-width: 140px; text-transform: uppercase; letter-spacing: 0.04em; }
        .info-value { flex: 1; color: #212529; }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="candidatures-header d-flex justify-content-between align-items-center flex-wrap">
            <div class="candidatures-title">
                <h3 class="mb-0">Candidature de {{ $candidature->prenom }} {{ $candidature->nom }}</h3>
                <span class="candidatures-subtitle">Détail de la candidature</span>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.projects.show', $candidature->project) }}" class="btn btn-info shadow-sm">Voir le projet</a>
                <a href="{{ route('admin.candidatures.index') }}" class="btn btn-secondary shadow-sm">Retour</a>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.candidatures.index') }}">Candidatures</a></li>
                    <li class="breadcrumb-item active">Détail</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4">
                <!-- Informations candidat -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header"><h5 class="mb-0">Informations</h5></div>
                        <div class="card-body">
                            <div class="info-row">
                                <span class="info-label">Nom</span>
                                <span class="info-value fw-semibold">{{ $candidature->prenom }} {{ $candidature->nom }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Email</span>
                                <span class="info-value">
                                    <a href="mailto:{{ $candidature->email }}">{{ $candidature->email }}</a>
                                </span>
                            </div>
                            @if ($candidature->telephone)
                                <div class="info-row">
                                    <span class="info-label">Téléphone</span>
                                    <span class="info-value">
                                        <a href="tel:{{ $candidature->telephone }}">{{ $candidature->telephone }}</a>
                                    </span>
                                </div>
                            @endif
                            <div class="info-row">
                                <span class="info-label">Projet</span>
                                <span class="info-value">
                                    <a href="{{ route('admin.projects.show', $candidature->project) }}">{{ $candidature->project->titre }}</a>
                                </span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Date</span>
                                <span class="info-value">{{ $candidature->created_at->format('d/m/Y à H:i') }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">CV</span>
                                <span class="info-value">
                                    @if ($candidature->cv_path)
                                        <a href="{{ asset('storage/' . $candidature->cv_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-file-earmark-arrow-down me-1"></i> Telecharger le CV
                                        </a>
                                    @else
                                        <span class="text-muted">Aucun CV joint</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Changer le statut -->
                    <div class="card mt-4">
                        <div class="card-header"><h5 class="mb-0">Statut de la candidature</h5></div>
                        <div class="card-body">
                            @php
                                $cStatutClass = match($candidature->statut) {
                                    'en_attente' => 'text-bg-secondary',
                                    'retenue'    => 'text-bg-success',
                                    'rejetee'    => 'text-bg-danger',
                                    default      => 'text-bg-secondary',
                                };
                                $cStatutLabel = match($candidature->statut) {
                                    'en_attente' => 'En attente',
                                    'retenue'    => 'Retenue',
                                    'rejetee'    => 'Rejetee',
                                    default      => $candidature->statut,
                                };
                            @endphp
                            <p class="mb-3">Statut actuel : <span class="badge {{ $cStatutClass }}">{{ $cStatutLabel }}</span></p>

                            <form action="{{ route('admin.candidatures.update', $candidature) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="statut" class="form-label">Changer le statut</label>
                                    <select name="statut" id="statut" class="form-select">
                                        <option value="en_attente" {{ $candidature->statut === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                        <option value="retenue" {{ $candidature->statut === 'retenue' ? 'selected' : '' }}>Retenue</option>
                                        <option value="rejetee" {{ $candidature->statut === 'rejetee' ? 'selected' : '' }}>Rejetee</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Lettre de motivation -->
                <div class="col-lg-8">
                    <div class="card h-100">
                        <div class="card-header"><h5 class="mb-0">Lettre de motivation</h5></div>
                        <div class="card-body">
                            <div style="white-space: pre-line; line-height: 1.7;">{{ $candidature->lettre_motivation }}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
