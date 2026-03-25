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
                <h3 class="mb-0">Modifier un partenaire</h3>
                <span class="partners-subtitle">Édition d'un partenaire existant</span>
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
                    <li class="breadcrumb-item active" aria-current="page">Modification</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header"><h3 class="card-title">Edition du partenaire</h3></div>
                <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom du partenaire</label>
                                <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $partner->nom) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lien" class="form-label">Lien du partenaire</label>
                                <input type="url" name="lien" id="lien" class="form-control" value="{{ old('lien', $partner->lien) }}" placeholder="https://...">
                                <small class="text-muted">Optionnel</small>
                            </div>
                            <div class="col-md-6">
                                <label for="logo" class="form-label">Remplacer le logo</label>
                                <input type="file" name="logo" id="logo" class="form-control" accept=".jpg,.jpeg,.png,.webp,.svg">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Logo actuel</label>
                                <div>
                                    <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->nom }}" style="max-width: 220px; max-height: 160px; object-fit: contain; background: #fff; border: 1px solid var(--bs-border-color); border-radius: 1rem; padding: 1rem;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Retour</a>
                        <button type="submit" class="btn btn-warning">Mettre a jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
