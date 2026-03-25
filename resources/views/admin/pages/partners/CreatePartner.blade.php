@extends('admin.layouts.admin')

@push('styles')
    <style>
        .partner-dropzone {
            border: 2px dashed #86b7fe;
            border-radius: 1rem;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.08), rgba(13, 202, 240, 0.12));
            padding: 2rem;
            text-align: center;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .partner-dropzone.is-dragover {
            border-color: #0d6efd;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.14), rgba(13, 202, 240, 0.18));
            transform: translateY(-2px);
        }

        .partner-input {
            display: none;
        }

        .logo-preview {
            max-width: 220px;
            max-height: 160px;
            object-fit: contain;
            background: #fff;
            border: 1px solid var(--bs-border-color);
            border-radius: 1rem;
            padding: 1rem;
        }

        .partners-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .partners-title h3 {
            font-family: inherit; /* même police que le tableau */
            font-weight: 600; /* proche des th des tables */
            font-size: 1.25rem; /* taille harmonisée */
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
                <h3 class="mb-0">Ajouter un partenaire</h3>
                <span class="partners-subtitle">Créer un nouveau partenaire</span>
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
                    <li class="breadcrumb-item active" aria-current="page">Création</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Formulaire de creation</h3></div>
                <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
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
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom du partenaire</label>
                                <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lien" class="form-label">Lien du partenaire</label>
                                <input type="url" name="lien" id="lien" class="form-control" value="{{ old('lien') }}" placeholder="https://...">
                                <small class="text-muted">Optionnel</small>
                            </div>
                            <div class="col-12">
                                <label class="form-label d-block">Logo</label>
                                <label for="logo" id="partner-dropzone" class="partner-dropzone w-100">
                                    <div class="fs-2 text-primary mb-2">
                                        <i class="bi bi-image"></i>
                                    </div>
                                    <h5 class="mb-2">Glisse le logo ici</h5>
                                    <p class="text-muted mb-2">ou clique pour parcourir tes fichiers</p>
                                    <small class="text-muted d-block">JPG, JPEG, PNG, WEBP, SVG.</small>
                                    <small id="partner-selection-label" class="d-block mt-3 fw-semibold text-primary"></small>
                                </label>
                                <input type="file" name="logo" id="logo" class="partner-input" accept=".jpg,.jpeg,.png,.webp,.svg" required>
                            </div>
                            <div class="col-12">
                                <div id="partner-preview-wrapper" class="d-none">
                                    <label class="form-label">Previsualisation du logo</label>
                                    <div>
                                        <img id="partner-preview" class="logo-preview" alt="Previsualisation du logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Retour</a>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('logo');
            const dropzone = document.getElementById('partner-dropzone');
            const selectionLabel = document.getElementById('partner-selection-label');
            const preview = document.getElementById('partner-preview');
            const previewWrapper = document.getElementById('partner-preview-wrapper');

            if (!input || !dropzone || !selectionLabel || !preview || !previewWrapper) {
                return;
            }

            const renderPreview = function () {
                const file = input.files[0];

                if (!file) {
                    selectionLabel.textContent = '';
                    previewWrapper.classList.add('d-none');
                    preview.removeAttribute('src');
                    return;
                }

                selectionLabel.textContent = file.name;
                preview.src = URL.createObjectURL(file);
                previewWrapper.classList.remove('d-none');
            };

            input.addEventListener('change', renderPreview);

            ['dragenter', 'dragover'].forEach(function (eventName) {
                dropzone.addEventListener(eventName, function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    dropzone.classList.add('is-dragover');
                });
            });

            ['dragleave', 'dragend', 'drop'].forEach(function (eventName) {
                dropzone.addEventListener(eventName, function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    dropzone.classList.remove('is-dragover');
                });
            });

            dropzone.addEventListener('drop', function (event) {
                if (!event.dataTransfer.files.length) {
                    return;
                }

                input.files = event.dataTransfer.files;
                renderPreview();
            });
        });
    </script>
@endpush
