@extends('admin.layouts.admin')

@push('styles')
    <style>
        .articles-toolbar {
            display: grid;
            gap: 1rem;
        }

        .articles-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .articles-title h3 {
            font-family: inherit; /* même police que le tableau */
            font-weight: 600; /* proche des th des tables */
            font-size: 1.25rem; /* taille harmonisée */
            color: #212529;
        }

        .articles-subtitle {
            font-family: inherit;
        }

        @media (min-width: 992px) {
            .articles-toolbar {
                grid-template-columns: minmax(0, 1fr) auto;
                align-items: end;
            }
        }

        .articles-filters {
            display: grid;
            gap: 0.75rem;
        }

        @media (min-width: 768px) {
            .articles-filters {
                grid-template-columns: minmax(0, 1.6fr) minmax(180px, 220px) auto;
                align-items: end;
            }
        }

        .sortable-link {
            color: inherit;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .sortable-link:hover {
            color: inherit;
        }

        .sortable-link i {
            font-size: 0.8rem;
            opacity: 0.65;
        }

        .delete-modal .modal-content {
            border: 0;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 1.5rem 3rem rgba(15, 23, 42, 0.2);
        }

        .delete-modal .modal-header {
            border-bottom: 0;
            padding: 1.25rem 1.25rem 0.5rem;
        }

        .delete-modal .modal-body {
            padding: 0.5rem 1.25rem 1rem;
        }

        .delete-modal .modal-footer {
            border-top: 0;
            padding: 0 1.25rem 1.25rem;
        }

        .delete-modal-icon {
            width: 4rem;
            height: 4rem;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(220, 53, 69, 0.12);
            color: #dc3545;
            font-size: 1.75rem;
        }

        .col-titre {
            max-width: 260px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="articles-header d-flex justify-content-between align-items-center flex-wrap">

            <!-- LEFT -->
            <div class="articles-title">
                <h3 class="mb-0">Liste des articles</h3>
                <span class="articles-subtitle">Gestion et suivi des articles</span>
            </div>

            <!-- RIGHT -->
            <div>
                <a href="{{ route('articles.create') }}" class="btn btn-primary shadow-sm">
                    Nouvel article
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
                    <li class="breadcrumb-item active">Articles</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <form id="articles-filters-form" action="{{ route('articles.index') }}" method="GET" class="articles-filters">
                        <div>
                            <label for="search" class="form-label mb-1">Recherche</label>
                            <input
                                type="text"
                                id="search"
                                name="search"
                                class="form-control"
                                value="{{ request('search') }}"
                                placeholder="Titre ou contenu..."
                            >
                        </div>
                        <div>
                            <label for="datePublication" class="form-label mb-1">Date</label>
                            <input
                                type="date"
                                id="datePublication"
                                name="datePublication"
                                class="form-control"
                                value="{{ request('datePublication') }}"
                            >
                        </div>
                        <div>
                            <label class="form-label mb-1 d-block">&nbsp;</label>
                            <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    @php
                        $currentSort = request('sort', 'id');
                        $currentDirection = request('direction', 'desc');

                        $sortUrl = function (string $column) use ($currentSort, $currentDirection) {
                            $direction = $currentSort === $column && $currentDirection === 'asc' ? 'desc' : 'asc';

                            return route('articles.index', array_merge(request()->query(), [
                                'sort' => $column,
                                'direction' => $direction,
                            ]));
                        };

                        $sortIcon = function (string $column) use ($currentSort, $currentDirection) {
                            if ($currentSort !== $column) {
                                return 'bi-arrow-down-up';
                            }

                            return $currentDirection === 'asc' ? 'bi-sort-up' : 'bi-sort-down';
                        };
                    @endphp
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 70px">
                                    <a href="{{ $sortUrl('id') }}" class="sortable-link">
                                        <span>#</span>
                                        <i class="bi {{ $sortIcon('id') }}"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ $sortUrl('titre') }}" class="sortable-link">
                                        <span>Titre</span>
                                        <i class="bi {{ $sortIcon('titre') }}"></i>
                                    </a>
                                </th>
                                <th>Description</th>
                                <th>
                                    <a href="{{ $sortUrl('datePublication') }}" class="sortable-link">
                                        <span>Date de publication</span>
                                        <i class="bi {{ $sortIcon('datePublication') }}"></i>
                                    </a>
                                </th>
                                <th>Image principale</th>
                                <th style="width: 160px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($articles as $article)
                                @php
                                    $imagePath = $article->coverImage?->image_path ?? $article->images->first()?->image_path;
                                    $imageUrl = $imagePath
                                        ? (\Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://'])
                                            ? $imagePath
                                            : asset('storage/' . $imagePath))
                                        : null;
                                @endphp
                                <tr>
                                    <td>{{ $article->id }}</td>
                                    <td class="fw-semibold col-titre" title="{{ $article->titre }}">{{ $article->titre }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit(strip_tags($article->description), 80) }}</td>
                                    <td>
                                        {{ $article->datePublication ? \Illuminate\Support\Carbon::parse($article->datePublication)->format('d/m/Y') : 'Non definie' }}
                                    </td>
                                    <td>
                                        @if ($imageUrl)
                                            <img
                                                src="{{ $imageUrl }}"
                                                alt="{{ $article->titre }}"
                                                class="img-thumbnail"
                                                style="width: 70px; height: 70px; object-fit: cover;"
                                            >
                                        @else
                                            <span class="badge text-bg-secondary">Aucune image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a
                                                href="{{ route('articles.show', $article) }}"
                                                class="btn btn-sm btn-info"
                                                title="Voir"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a
                                                href="{{ route('articles.edit', $article) }}"
                                                class="btn btn-sm btn-warning"
                                                title="Modifier"
                                            >
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="delete-article-form" data-article-title="{{ $article->titre }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger delete-article-button" title="Supprimer">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Aucun article disponible pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($articles->hasPages())
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-center">
                            {{ $articles->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade delete-modal" id="deleteArticleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="delete-modal-icon">
                        <i class="bi bi-trash3"></i>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="mb-2">Supprimer cet article ?</h4>
                    <p class="text-muted mb-0">
                        Tu es sur le point de supprimer <span id="delete-article-name" class="fw-semibold text-dark"></span>.
                        Cette action est definitive.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete-article">Oui, supprimer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filtersForm = document.getElementById('articles-filters-form');
            const searchInput = document.getElementById('search');
            const dateInput = document.getElementById('datePublication');
            const modalElement = document.getElementById('deleteArticleModal');
            let searchTimeout;

            if (searchInput && filtersForm) {
                searchInput.addEventListener('input', function () {
                    window.clearTimeout(searchTimeout);
                    searchTimeout = window.setTimeout(function () {
                        filtersForm.submit();
                    }, 400);
                });
            }

            if (dateInput && filtersForm) {
                dateInput.addEventListener('change', function () {
                    filtersForm.submit();
                });
            }

            if (!modalElement || !window.bootstrap) {
                return;
            }

            const deleteModal = new bootstrap.Modal(modalElement);
            const articleName = document.getElementById('delete-article-name');
            const confirmButton = document.getElementById('confirm-delete-article');
            let currentForm = null;

            document.querySelectorAll('.delete-article-button').forEach(function (button) {
                button.addEventListener('click', function () {
                    currentForm = button.closest('.delete-article-form');
                    articleName.textContent = currentForm?.dataset.articleTitle || 'cet article';
                    deleteModal.show();
                });
            });

            confirmButton.addEventListener('click', function () {
                if (currentForm) {
                    currentForm.submit();
                }
            });

            modalElement.addEventListener('hidden.bs.modal', function () {
                currentForm = null;
                articleName.textContent = '';
            });
        });
    </script>
@endpush
