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
    </div>
@endsection
