@extends('admin.layouts.admin')

@push('styles')
    <style>
        .editor-shell textarea { min-height: 320px; }
        .editor-shell .tox-tinymce { border-radius: 1rem; border-color: var(--bs-border-color); }

        .upload-dropzone {
            border: 2px dashed #86b7fe; border-radius: 1rem;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.08), rgba(13, 202, 240, 0.12));
            padding: 2rem; text-align: center; transition: all 0.2s ease; cursor: pointer;
        }
        .upload-dropzone.is-dragover {
            border-color: #0d6efd;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.14), rgba(13, 202, 240, 0.18));
            transform: translateY(-2px); box-shadow: 0 1rem 2rem rgba(13, 110, 253, 0.12);
        }
        .upload-dropzone-icon {
            width: 4rem; height: 4rem; display: inline-flex; align-items: center; justify-content: center;
            border-radius: 999px; background: rgba(255, 255, 255, 0.9); color: #0d6efd; font-size: 1.5rem; margin-bottom: 1rem;
        }
        .upload-input { display: none; }
        .preview-card { overflow: hidden; border: 0; border-radius: 1rem; box-shadow: 0 0.5rem 1.5rem rgba(33, 37, 41, 0.08); }
        .preview-card img { height: 180px; object-fit: cover; }
        .preview-remove {
            position: absolute; top: 0.75rem; right: 0.75rem; width: 2rem; height: 2rem;
            display: inline-flex; align-items: center; justify-content: center;
            border: 0; border-radius: 999px; background: rgba(220, 53, 69, 0.92); color: #fff;
            box-shadow: 0 0.5rem 1rem rgba(220, 53, 69, 0.2);
        }
        .preview-remove:hover { background: #dc3545; }
        .existing-image-card { border-radius: 1rem; overflow: hidden; border: 1px solid var(--bs-border-color); }
        .existing-image-card img { width: 100%; height: 180px; object-fit: cover; }

        .projects-header {
            background: #fff; padding: 1.2rem 1.5rem;
            border-radius: 1rem; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .projects-title h3 { font-family: inherit; font-weight: 600; font-size: 1.25rem; color: #212529; }
        .projects-subtitle { font-family: inherit; }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="projects-header d-flex justify-content-between align-items-center flex-wrap">
            <div class="projects-title">
                <h3 class="mb-0">Modifier un projet</h3>
                <span class="projects-subtitle">Édition d'un projet existant</span>
            </div>
            <div>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary shadow-sm">Retour</a>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projets</a></li>
                    <li class="breadcrumb-item active">Modification</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Edition du projet</h3>
                </div>

                <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="titre" class="form-label">Titre</label>
                            <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre', $project->titre) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <div class="editor-shell">
                                <textarea name="description" id="description" rows="10" class="form-control" required>{{ old('description', $project->description) }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="datePublication" class="form-label">Date de publication</label>
                                <input type="date" name="datePublication" id="datePublication" class="form-control" value="{{ old('datePublication', $defaultPublicationDate) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="statut" class="form-label">Statut</label>
                                <select name="statut" id="statut" class="form-select" required>
                                    <option value="ouvert" {{ old('statut', $project->statut) === 'ouvert' ? 'selected' : '' }}>Ouvert (candidatures acceptees)</option>
                                    <option value="ferme" {{ old('statut', $project->statut) === 'ferme' ? 'selected' : '' }}>Ferme (candidatures closes)</option>
                                    <option value="archive" {{ old('statut', $project->statut) === 'archive' ? 'selected' : '' }}>Archive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Images existantes</label>
                            <div class="row g-3">
                                @forelse ($project->images as $image)
                                    @php
                                        $imageUrl = asset('storage/' . $image->image_path);
                                        $oldRemovedImages = collect(old('remove_images', []))->map(fn ($id) => (int) $id)->all();
                                        $selectedCoverId = (int) old('cover_image_id', $project->imageId);
                                    @endphp
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="existing-image-card h-100">
                                            <img src="{{ $imageUrl }}" alt="Image projet {{ $image->id }}">
                                            <div class="p-3">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" name="cover_image_id" value="{{ $image->id }}" id="cover_image_{{ $image->id }}" {{ $selectedCoverId === $image->id ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="cover_image_{{ $image->id }}">Image principale</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remove_images[]" value="{{ $image->id }}" id="remove_image_{{ $image->id }}" {{ in_array($image->id, $oldRemovedImages, true) ? 'checked' : '' }}>
                                                    <label class="form-check-label text-danger" for="remove_image_{{ $image->id }}">Supprimer cette image</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-secondary mb-0">Aucune image enregistree pour ce projet.</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Ajouter de nouvelles images</label>
                            <label for="images" id="upload-dropzone" class="upload-dropzone w-100">
                                <span class="upload-dropzone-icon"><i class="bi bi-cloud-arrow-up"></i></span>
                                <h5 class="mb-2">Glisse de nouvelles images ici</h5>
                                <p class="text-muted mb-2">ou clique pour parcourir tes fichiers</p>
                                <small class="text-muted d-block">JPG, JPEG, PNG, WEBP.</small>
                                <small id="upload-selection-label" class="d-block mt-3 fw-semibold text-primary"></small>
                            </label>
                            <input type="file" name="images[]" id="images" class="upload-input" accept=".jpg,.jpeg,.png,.webp" multiple>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Previsualisation des nouvelles images</label>
                            <div class="d-flex justify-content-end mb-2">
                                <button type="button" id="clear-images" class="btn btn-sm btn-outline-danger d-none">Tout deselectionner</button>
                            </div>
                            <div id="image-preview" class="row g-3"></div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Retour</a>
                        <button type="submit" class="btn btn-warning">Mettre a jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const initEditProjectPage = function () {
            const form = document.querySelector('form[action="{{ route('admin.projects.update', $project) }}"]');

            if (window.tinymce && !window.tinymce.get('description')) {
                window.tinymce.init({
                    selector: '#description',
                    height: 320,
                    menubar: false,
                    branding: false,
                    promotion: false,
                    license_key: 'gpl',
                    plugins: 'advlist autolink lists link image table code wordcount',
                    toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | alignleft aligncenter alignright | link image table | code',
                    content_style: 'body { font-family: "Source Sans 3", sans-serif; font-size: 16px; }',
                    setup: function (editor) {
                        editor.on('init', function () { editor.mode.set('design'); });
                        editor.on('change keyup undo redo', function () { window.tinymce.triggerSave(); });
                    }
                });
            }

            if (form) {
                form.addEventListener('submit', function () {
                    if (window.tinymce) window.tinymce.triggerSave();
                });
            }

            const input = document.getElementById('images');
            const preview = document.getElementById('image-preview');
            const dropzone = document.getElementById('upload-dropzone');
            const selectionLabel = document.getElementById('upload-selection-label');
            const clearButton = document.getElementById('clear-images');
            let selectedFiles = [];

            if (!input || !preview || !dropzone || !selectionLabel || !clearButton) return;

            const syncInputFiles = function () {
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(function (file) { dataTransfer.items.add(file); });
                input.files = dataTransfer.files;
            };

            const renderPreview = function () {
                preview.innerHTML = '';
                selectionLabel.textContent = selectedFiles.length ? selectedFiles.length + ' image(s) selectionnee(s)' : '';
                clearButton.classList.toggle('d-none', selectedFiles.length === 0);
                selectedFiles.forEach(function (file, index) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        const col = document.createElement('div');
                        col.className = 'col-sm-6 col-md-4 col-lg-3';
                        col.innerHTML = `<div class="card preview-card h-100 position-relative"><button type="button" class="preview-remove" data-index="${index}" title="Retirer"><i class="bi bi-x-lg"></i></button><img src="${event.target.result}" class="card-img-top" alt="${file.name}"><div class="card-body p-3"><div class="fw-semibold text-truncate">${file.name}</div><small class="text-muted">${Math.round(file.size / 1024)} Ko</small></div></div>`;
                        preview.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                });
            };

            input.addEventListener('change', function () {
                selectedFiles = Array.from(input.files);
                renderPreview();
            });

            preview.addEventListener('click', function (event) {
                const button = event.target.closest('.preview-remove');
                if (!button) return;
                selectedFiles = selectedFiles.filter(function (_f, i) { return i !== Number(button.dataset.index); });
                syncInputFiles();
                renderPreview();
            });

            clearButton.addEventListener('click', function () {
                selectedFiles = [];
                input.value = '';
                syncInputFiles();
                renderPreview();
            });

            ['dragenter', 'dragover'].forEach(function (en) {
                dropzone.addEventListener(en, function (e) { e.preventDefault(); e.stopPropagation(); dropzone.classList.add('is-dragover'); });
            });

            ['dragleave', 'dragend', 'drop'].forEach(function (en) {
                dropzone.addEventListener(en, function (e) { e.preventDefault(); e.stopPropagation(); dropzone.classList.remove('is-dragover'); });
            });

            dropzone.addEventListener('drop', function (event) {
                if (event.dataTransfer.files.length) {
                    selectedFiles = Array.from(event.dataTransfer.files);
                    syncInputFiles();
                    renderPreview();
                }
            });

            renderPreview();
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initEditProjectPage);
        } else {
            initEditProjectPage();
        }
    </script>
@endpush
