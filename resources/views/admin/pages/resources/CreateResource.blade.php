@extends('admin.layouts.admin')

@push('styles')
    <style>
        .resource-dropzone {
            border: 2px dashed #86b7fe;
            border-radius: 1rem;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.08), rgba(13, 202, 240, 0.12));
            padding: 2rem;
            text-align: center;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .resource-dropzone.is-dragover {
            border-color: #0d6efd;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.14), rgba(13, 202, 240, 0.18));
            transform: translateY(-2px);
        }

        .resource-dropzone-icon {
            width: 4rem;
            height: 4rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.9);
            color: #0d6efd;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .resource-input {
            display: none;
        }

        .resource-preview-card {
            border-radius: 1rem;
            border: 1px solid var(--bs-border-color);
            padding: 1rem;
            background: #fff;
        }

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
                <h3 class="mb-0">Ajouter une ressource</h3>
                <span class="resources-subtitle">Créer une nouvelle ressource</span>
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
                <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label for="titre" class="form-label">Titre</label>
                                <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="categorie" class="form-label">Categorie</label>
                                <select name="categorie" id="categorie" class="form-select" required>
                                    <option value="">Choisir une categorie</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category }}" {{ old('categorie') === $category ? 'selected' : '' }}>
                                            {{ ucfirst($category) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="datePublication" class="form-label">Date de publication</label>
                                <input type="date" name="datePublication" id="datePublication" class="form-control" value="{{ old('datePublication', $defaultPublicationDate) }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label d-block">Fichier PDF ou DOCX</label>
                                <label for="file" id="resource-dropzone" class="resource-dropzone w-100">
                                    <span class="resource-dropzone-icon">
                                        <i class="bi bi-file-earmark-arrow-up"></i>
                                    </span>
                                    <h5 class="mb-2">Glisse ton fichier ici</h5>
                                    <p class="text-muted mb-2">ou clique pour parcourir tes fichiers</p>
                                    <small class="text-muted d-block">Formats acceptes : PDF, DOC, DOCX.</small>
                                    <small id="resource-selection-label" class="d-block mt-3 fw-semibold text-primary"></small>
                                </label>
                                <input type="file" name="file" id="file" class="resource-input" accept=".pdf,.doc,.docx" required>
                            </div>
                            <div class="col-12">
                                <div id="resource-preview" class="resource-preview-card d-none"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.resources.index') }}" class="btn btn-secondary">Retour</a>
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
            const input = document.getElementById('file');
            const dropzone = document.getElementById('resource-dropzone');
            const selectionLabel = document.getElementById('resource-selection-label');
            const preview = document.getElementById('resource-preview');

            if (!input || !dropzone || !selectionLabel || !preview) {
                return;
            }

            const renderPreview = function () {
                const file = input.files[0];

                if (!file) {
                    selectionLabel.textContent = '';
                    preview.classList.add('d-none');
                    preview.innerHTML = '';
                    return;
                }

                selectionLabel.textContent = file.name;
                preview.classList.remove('d-none');
                preview.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <div class="fw-semibold">${file.name}</div>
                            <small class="text-muted">${Math.round(file.size / 1024)} Ko</small>
                        </div>
                        <span class="badge text-bg-primary">${file.name.split('.').pop().toUpperCase()}</span>
                    </div>
                `;
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
