@extends('admin.layouts.admin')

@push('styles')
    <style>
        .upload-dropzone {
            border: 2px dashed #86b7fe;
            border-radius: 1rem;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.08), rgba(13, 202, 240, 0.12));
            padding: 2rem;
            text-align: center;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .upload-dropzone.is-dragover {
            border-color: #0d6efd;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.14), rgba(13, 202, 240, 0.18));
            transform: translateY(-2px);
            box-shadow: 0 1rem 2rem rgba(13, 110, 253, 0.12);
        }

        .upload-dropzone-icon {
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

        .upload-input {
            display: none;
        }

        .preview-card {
            overflow: hidden;
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1.5rem rgba(33, 37, 41, 0.08);
        }

        .preview-media {
            width: 100%;
            height: 190px;
            object-fit: cover;
            background: #e9ecef;
        }

        .preview-remove {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            width: 2rem;
            height: 2rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 999px;
            background: rgba(220, 53, 69, 0.92);
            color: #fff;
            box-shadow: 0 0.5rem 1rem rgba(220, 53, 69, 0.2);
        }

        .preview-remove:hover {
            background: #dc3545;
        }

        .galleries-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .galleries-title h3 {
            font-family: inherit; /* même police que le tableau */
            font-weight: 600; /* proche des th des tables */
            font-size: 1.25rem; /* taille harmonisée */
            color: #212529;
        }

        .galleries-subtitle {
            font-family: inherit;
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="galleries-header d-flex justify-content-between align-items-center flex-wrap">

            <!-- LEFT -->
            <div class="galleries-title">
                <h3 class="mb-0">Créer une galerie</h3>
                <span class="galleries-subtitle">Ajouter une nouvelle galerie</span>
            </div>

            <!-- RIGHT -->
            <div>
                <a href="{{ route('galleries.index') }}" class="btn btn-secondary shadow-sm">
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
                    <li class="breadcrumb-item"><a href="{{ route('galleries.index') }}">Galeries</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Création</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de creation</h3>
                </div>

                <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
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

                        <div class="mb-3">
                            <label for="titre" class="form-label">Titre</label>
                            <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Photos et videos</label>
                            <label for="medias" id="upload-dropzone" class="upload-dropzone w-100">
                                <span class="upload-dropzone-icon">
                                    <i class="bi bi-cloud-arrow-up"></i>
                                </span>
                                <h5 class="mb-2">Glisse tes medias ici</h5>
                                <p class="text-muted mb-2">ou clique pour parcourir tes fichiers</p>
                                <small class="text-muted d-block">JPG, JPEG, PNG, WEBP, MP4, MOV, AVI, WEBM.</small>
                                <small id="upload-selection-label" class="d-block mt-3 fw-semibold text-primary"></small>
                            </label>
                            <input type="file" name="medias[]" id="medias" class="upload-input" accept=".jpg,.jpeg,.png,.webp,.mp4,.mov,.avi,.webm" multiple required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Previsualisation</label>
                            <div class="d-flex justify-content-end mb-2">
                                <button type="button" id="clear-medias" class="btn btn-sm btn-outline-danger d-none">Tout deselectionner</button>
                            </div>
                            <div id="media-preview" class="row g-3"></div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Retour</a>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const initCreateGalleryPage = function () {
            const input = document.getElementById('medias');
            const preview = document.getElementById('media-preview');
            const dropzone = document.getElementById('upload-dropzone');
            const selectionLabel = document.getElementById('upload-selection-label');
            const clearButton = document.getElementById('clear-medias');
            let selectedFiles = Array.from(input?.files ?? []);

            if (!input || !preview || !dropzone || !selectionLabel || !clearButton) {
                return;
            }

            const syncInputFiles = function () {
                const dataTransfer = new DataTransfer();

                selectedFiles.forEach(function (file) {
                    dataTransfer.items.add(file);
                });

                input.files = dataTransfer.files;
            };

            const renderPreview = function () {
                preview.innerHTML = '';
                selectionLabel.textContent = selectedFiles.length ? selectedFiles.length + ' media(s) selectionne(s)' : '';
                clearButton.classList.toggle('d-none', selectedFiles.length === 0);

                selectedFiles.forEach(function (file, index) {
                    const isVideo = file.type.startsWith('video/');
                    const col = document.createElement('div');
                    col.className = 'col-sm-6 col-md-4 col-lg-3';
                    const previewUrl = URL.createObjectURL(file);

                    col.innerHTML = `
                        <div class="card preview-card h-100 position-relative">
                            <span class="badge ${isVideo ? 'text-bg-dark' : 'text-bg-primary'} position-absolute top-0 start-0 m-2">
                                ${isVideo ? 'Video' : 'Image'}
                            </span>
                            <button type="button" class="preview-remove" data-index="${index}" title="Retirer ce media">
                                <i class="bi bi-x-lg"></i>
                            </button>
                            ${isVideo ? `<video src="${previewUrl}" class="preview-media" controls muted playsinline></video>` : `<img src="${previewUrl}" class="preview-media" alt="${file.name}">`}
                            <div class="card-body p-3">
                                <div class="fw-semibold text-truncate">${file.name}</div>
                                <small class="text-muted">${Math.round(file.size / 1024)} Ko</small>
                            </div>
                        </div>
                    `;

                    preview.appendChild(col);
                });
            };

            const syncFiles = function (fileList) {
                selectedFiles = Array.from(fileList);
                syncInputFiles();
                renderPreview();
            };

            input.addEventListener('change', function () {
                selectedFiles = Array.from(input.files);
                renderPreview();
            });

            preview.addEventListener('click', function (event) {
                const button = event.target.closest('.preview-remove');

                if (!button) {
                    return;
                }

                const index = Number(button.dataset.index);
                selectedFiles = selectedFiles.filter(function (_file, fileIndex) {
                    return fileIndex !== index;
                });

                syncInputFiles();
                renderPreview();
            });

            clearButton.addEventListener('click', function () {
                selectedFiles = [];
                input.value = '';
                syncInputFiles();
                renderPreview();
            });

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
                if (event.dataTransfer.files.length) {
                    syncFiles(event.dataTransfer.files);
                }
            });

            renderPreview();
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCreateGalleryPage);
        } else {
            initCreateGalleryPage();
        }
    </script>
@endpush
