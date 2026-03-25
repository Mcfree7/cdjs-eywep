@extends('admin.layouts.admin')

@push('styles')
    <style>
        .news-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .news-title h3 {
            font-family: inherit;
            font-weight: 600;
            font-size: 1.25rem;
            color: #212529;
        }

        .news-subtitle {
            font-family: inherit;
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="news-header d-flex justify-content-between align-items-center flex-wrap">

            <!-- LEFT -->
            <div class="news-title">
                <h3 class="mb-0">Modifier un breaking news</h3>
                <span class="news-subtitle">Édition d'un breaking news existant</span>
            </div>

            <!-- RIGHT -->
            <div>
                <a href="{{ route('news.index') }}" class="btn btn-secondary shadow-sm">
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
                    <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Breaking News</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modification</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Edition du breaking news</h3>
                </div>

                <form action="{{ route('news.update', $news) }}" method="POST">
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

                        <div class="mb-3">
                            <label for="titre" class="form-label">Titre</label>
                            <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre', $news->titre) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Statut</label>
                            <select name="status" id="status" class="form-select" required>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" {{ old('status', $news->status) === $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('news.index') }}" class="btn btn-secondary">Retour</a>
                        <button type="submit" class="btn btn-warning">Mettre a jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
