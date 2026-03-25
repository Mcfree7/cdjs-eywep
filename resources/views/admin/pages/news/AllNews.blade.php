@extends('admin.layouts.admin')

@push('styles')
    <style>
        .news-toolbar {
            display: grid;
            gap: 1rem;
        }

        .news-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .news-title h3 {
            font-family: inherit; /* même police que le tableau */
            font-weight: 600; /* proche des th des tables */
            font-size: 1.25rem; /* taille harmonisée */
            color: #212529;
        }

        .news-subtitle {
            font-family: inherit;
        }

        @media (min-width: 992px) {
            .news-toolbar {
                grid-template-columns: minmax(0, 1fr) auto;
                align-items: end;
            }
        }

        .news-filters {
            display: grid;
            gap: 0.75rem;
        }

        @media (min-width: 768px) {
            .news-filters {
                grid-template-columns: minmax(0, 1.2fr) minmax(180px, 220px) auto;
                align-items: end;
            }
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
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="news-header d-flex justify-content-between align-items-center flex-wrap">

            <!-- LEFT -->
            <div class="news-title">
                <h3 class="mb-0">Breaking News</h3>
                <span class="news-subtitle">Gestion et suivi des actualités</span>
            </div>

            <!-- RIGHT -->
            <div>
                <a href="{{ route('news.create') }}" class="btn btn-primary shadow-sm">
                    Nouveau breaking news
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
                    <li class="breadcrumb-item active">Breaking News</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <form id="news-filters-form" action="{{ route('news.index') }}" method="GET" class="news-filters">
                        <div>
                            <label for="search" class="form-label mb-1">Recherche</label>
                            <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Titre...">
                        </div>
                        <div>
                            <label for="status" class="form-label mb-1">Statut</label>
                            <select id="status" name="status" class="form-select">
                                <option value="">Tous les statuts</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="form-label mb-1 d-block">&nbsp;</label>
                            <a href="{{ route('news.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 80px">#</th>
                                <th>Titre</th>
                                <th>Statut</th>
                                <th>Creation</th>
                                <th style="width: 160px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($news as $newsItem)
                                <tr>
                                    <td>{{ $newsItem->id }}</td>
                                    <td class="fw-semibold">{{ $newsItem->titre }}</td>
                                    <td>
                                        <span class="badge {{ $newsItem->status === 'actif' ? 'text-bg-success' : 'text-bg-secondary' }}">
                                            {{ ucfirst($newsItem->status) }}
                                        </span>
                                    </td>
                                    <td>{{ optional($newsItem->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('news.show', $newsItem) }}" class="btn btn-sm btn-info" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('news.edit', $newsItem) }}" class="btn btn-sm btn-warning" title="Modifier">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('news.destroy', $newsItem) }}" method="POST" class="delete-news-form" data-news-title="{{ $newsItem->titre }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger delete-news-button" title="Supprimer">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">Aucune breaking news disponible pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($news->hasPages())
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-center">
                            {{ $news->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade delete-modal" id="deleteNewsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="delete-modal-icon">
                        <i class="bi bi-trash3"></i>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="mb-2">Supprimer ce breaking news ?</h4>
                    <p class="text-muted mb-0">
                        Tu es sur le point de supprimer <span id="delete-news-name" class="fw-semibold text-dark"></span>.
                        Cette action est definitive.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete-news">Oui, supprimer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filtersForm = document.getElementById('news-filters-form');
            const searchInput = document.getElementById('search');
            const statusInput = document.getElementById('status');
            const modalElement = document.getElementById('deleteNewsModal');
            let searchTimeout;

            if (searchInput && filtersForm) {
                searchInput.addEventListener('input', function () {
                    window.clearTimeout(searchTimeout);
                    searchTimeout = window.setTimeout(function () {
                        filtersForm.submit();
                    }, 400);
                });
            }

            if (statusInput && filtersForm) {
                statusInput.addEventListener('change', function () {
                    filtersForm.submit();
                });
            }

            if (!modalElement || !window.bootstrap) {
                return;
            }

            const deleteModal = new bootstrap.Modal(modalElement);
            const newsName = document.getElementById('delete-news-name');
            const confirmButton = document.getElementById('confirm-delete-news');
            let currentForm = null;

            document.querySelectorAll('.delete-news-button').forEach(function (button) {
                button.addEventListener('click', function () {
                    currentForm = button.closest('.delete-news-form');
                    newsName.textContent = currentForm?.dataset.newsTitle || 'ce breaking news';
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
                newsName.textContent = '';
            });
        });
    </script>
@endpush
