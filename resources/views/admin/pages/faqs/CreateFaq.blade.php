@extends('admin.layouts.admin')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2"
                 style="background:#fff;padding:1.2rem 1.5rem;border-radius:1rem;box-shadow:0 8px 20px rgba(0,0,0,.05);">
                <div>
                    <h3 class="mb-0 fw-600" style="font-size:1.25rem;">Ajouter une question</h3>
                    <span class="text-muted small">Créer une nouvelle entrée FAQ</span>
                </div>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary shadow-sm">Retour</a>
            </div>
            <div class="row mt-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.faqs.index') }}">FAQ</a></li>
                        <li class="breadcrumb-item active">Création</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Formulaire de création</h3></div>
                <form action="{{ route('admin.faqs.store') }}" method="POST">
                    @csrf
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
                            <div class="col-12">
                                <label for="question" class="form-label">Question <span class="text-danger">*</span></label>
                                <input type="text" name="question" id="question" class="form-control @error('question') is-invalid @enderror"
                                       value="{{ old('question') }}" required maxlength="255">
                                @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label for="reponse" class="form-label">Réponse <span class="text-danger">*</span></label>
                                <textarea name="reponse" id="reponse" rows="5"
                                          class="form-control @error('reponse') is-invalid @enderror" required>{{ old('reponse') }}</textarea>
                                @error('reponse')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="ordre" class="form-label">Ordre d'affichage</label>
                                <input type="number" name="ordre" id="ordre" class="form-control @error('ordre') is-invalid @enderror"
                                       value="{{ old('ordre', 0) }}" min="0">
                                <small class="text-muted">0 = affiché en premier</small>
                                @error('ordre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 d-flex align-items-center mt-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="actif" id="actif"
                                           value="1" {{ old('actif', '1') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="actif">Actif (visible sur le site)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Retour</a>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
