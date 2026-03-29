@extends('admin.layouts.admin')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2"
                 style="background:#fff;padding:1.2rem 1.5rem;border-radius:1rem;box-shadow:0 8px 20px rgba(0,0,0,.05);">
                <div>
                    <h3 class="mb-0 fw-600" style="font-size:1.25rem;">Détail de la question</h3>
                    <span class="text-muted small">FAQ #{{ $faq->id }}</span>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-warning shadow-sm">Modifier</a>
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary shadow-sm">Retour</a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.faqs.index') }}">FAQ</a></li>
                        <li class="breadcrumb-item active">#{{ $faq->id }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Question</dt>
                        <dd class="col-sm-9">{{ $faq->question }}</dd>

                        <dt class="col-sm-3">Réponse</dt>
                        <dd class="col-sm-9" style="white-space:pre-wrap;">{{ $faq->reponse }}</dd>

                        <dt class="col-sm-3">Ordre</dt>
                        <dd class="col-sm-9">{{ $faq->ordre }}</dd>

                        <dt class="col-sm-3">Statut</dt>
                        <dd class="col-sm-9">
                            @if ($faq->actif)
                                <span class="badge text-bg-success">Actif</span>
                            @else
                                <span class="badge text-bg-secondary">Inactif</span>
                            @endif
                        </dd>

                        <dt class="col-sm-3">Créé le</dt>
                        <dd class="col-sm-9">{{ $faq->created_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection
