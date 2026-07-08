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
                <h3 class="mb-0">Modifier une ressource</h3>
                <span class="resources-subtitle">Édition d'une ressource existante</span>
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
                    <li class="breadcrumb-item active" aria-current="page">Modification</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header"><h3 class="card-title">Edition de la ressource</h3></div>
                <form action="{{ route('admin.resources.update', $resourceItem) }}" method="POST" enctype="multipart/form-data">
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
                                <label for="titre" class="form-label">Titre</label>
                                <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre', $resourceItem->titre) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="categorie" class="form-label">Categorie</label>
                                <select name="categorie" id="categorie" class="form-select" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category }}" {{ old('categorie', $resourceItem->categorie) === $category ? 'selected' : '' }}>
                                            {{ ucfirst($category) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $resourceItem->description) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="datePublication" class="form-label">Date de publication</label>
                                <input type="date" name="datePublication" id="datePublication" class="form-control" value="{{ old('datePublication', $defaultPublicationDate) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="file" class="form-label">Remplacer le fichier</label>
                                <input type="file" name="file" id="file" class="form-control" accept=".pdf,.doc,.docx">
                                <small class="text-muted d-block mt-2">Fichier actuel : {{ $resourceItem->file_name }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.resources.index') }}" class="btn btn-secondary">Retour</a>
                        <button type="submit" class="btn btn-warning">Mettre a jour</button>
                    </div>
                </form>
            </div>
        </div>

            {{-- Documents supplémentaires --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">Documents supplémentaires</h3>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($resourceItem->files->isNotEmpty())
                        <div class="list-group mb-4">
                            @foreach ($resourceItem->files as $file)
                            <div class="list-group-item d-flex align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-3 text-truncate">
                                    <span class="badge text-bg-{{ $file->file_type === 'pdf' ? 'danger' : 'primary' }}">{{ strtoupper($file->file_type) }}</span>
                                    <div class="text-truncate">
                                        <div class="fw-semibold">{{ $file->titre }}</div>
                                        <small class="text-muted">{{ $file->file_name }}</small>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 flex-shrink-0">
                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="btn btn-sm btn-info" title="Ouvrir">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.resources.files.destroy', $file) }}" method="POST" onsubmit="return confirm('Supprimer ce document ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-4">Aucun document supplémentaire pour l'instant.</p>
                    @endif

                    <form action="{{ route('admin.resources.files.store', $resourceItem) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @error('extra_titre')
                            <div class="alert alert-danger mb-3">{{ $message }}</div>
                        @enderror
                        @error('extra_file')
                            <div class="alert alert-danger mb-3">{{ $message }}</div>
                        @enderror
                        <div class="row g-2 align-items-end">
                            <div class="col-md-5">
                                <label for="extra_titre" class="form-label fw-semibold">Titre du document <span class="text-danger">*</span></label>
                                <input type="text" name="extra_titre" id="extra_titre" class="form-control" placeholder="Ex : Annexe financière" required>
                            </div>
                            <div class="col-md-5">
                                <label for="extra_file" class="form-label fw-semibold">Fichier <span class="text-danger">*</span></label>
                                <input type="file" name="extra_file" id="extra_file" class="form-control" accept=".pdf,.doc,.docx" required>
                                <small class="text-muted">PDF, DOC ou DOCX — max 20 Mo</small>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-plus-circle me-1"></i> Ajouter
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
