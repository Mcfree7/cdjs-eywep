@extends('admin.layouts.admin')

@push('styles')
    <style>
        .resources-toolbar {
            display: grid;
            gap: 1rem;
        }

        .resources-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .resources-title h3 {
            font-family: inherit; /* même police que le tableau */
            font-weight: 600; /* proche des th des tables */
            font-size: 1.25rem; /* taille harmonisée */
            color: #212529;
        }

        .resources-subtitle {
            font-family: inherit;
        }

        @media (min-width: 992px) {
            .resources-toolbar {
                grid-template-columns: minmax(0, 1fr) auto;
                align-items: end;
            }
        }

        .resources-filters {
            display: grid;
            gap: 0.75rem;
        }

        @media (min-width: 768px) {
            .resources-filters {
                grid-template-columns: minmax(0, 1.2fr) minmax(220px, 260px) auto;
                align-items: end;
            }
        }

        .resource-file-badge {
            width: 3rem;
            height: 3rem;
            border-radius: 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #fff;
        }

        .resource-file-badge.pdf {
            background: #dc3545;
        }

        .resource-file-badge.doc,
        .resource-file-badge.docx {
            background: #0d6efd;
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

        <div class="resources-header d-flex justify-content-between align-items-center flex-wrap">

            <!-- LEFT -->
            <div class="resources-title">
                <h3 class="mb-0">Bibliotheque documentaire</h3>
                <span class="resources-subtitle">Gestion et suivi des ressources</span>
            </div>

            <!-- RIGHT -->
            <div>
                <a href="{{ route('admin.resources.create') }}" class="btn btn-primary shadow-sm">
                    Nouvelle ressource
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
                    <li class="breadcrumb-item active">Ressources</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <form id="resources-filters-form" action="{{ route('admin.resources.index') }}" method="GET" class="resources-filters">
                        <div>
                            <label for="search" class="form-label mb-1">Recherche</label>
                            <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Titre ou description...">
                        </div>
                        <div>
                            <label for="categorie" class="form-label mb-1">Categorie</label>
                            <select id="categorie" name="categorie" class="form-select">
                                <option value="">Toutes les categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}" {{ request('categorie') === $category ? 'selected' : '' }}>
                                        {{ ucfirst($category) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="form-label mb-1 d-block">&nbsp;</label>
                            <a href="{{ route('admin.resources.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 80px">#</th>
                                <th>Type</th>
                                <th>Titre</th>
                                <th>Categorie</th>
                                <th>Fichier</th>
                                <th>Date de publication</th>
                                <th style="width: 160px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($resources as $resourceItem)
                                <tr>
                                    <td>{{ $resourceItem->id }}</td>
                                    <td>
                                        <span class="resource-file-badge {{ $resourceItem->file_type }}">
                                            {{ strtoupper($resourceItem->file_type) }}
                                        </span>
                                    </td>
                                    <td class="fw-semibold">{{ $resourceItem->titre }}</td>
                                    <td><span class="badge text-bg-secondary">{{ ucfirst($resourceItem->categorie) }}</span></td>
                                    <td>{{ \Illuminate\Support\Str::limit($resourceItem->file_name, 32) }}</td>
                                    <td>{{ optional($resourceItem->datePublication)->format('d/m/Y') ?? 'Non definie' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.resources.show', $resourceItem) }}" class="btn btn-sm btn-info" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.resources.edit', $resourceItem) }}" class="btn btn-sm btn-warning" title="Modifier">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('admin.resources.destroy', $resourceItem) }}" method="POST" class="delete-resource-form" data-resource-title="{{ $resourceItem->titre }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger delete-resource-button" title="Supprimer">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">Aucune ressource disponible pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($resources->hasPages())
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-center">
                            {{ $resources->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade delete-modal" id="deleteResourceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="delete-modal-icon">
                        <i class="bi bi-trash3"></i>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="mb-2">Supprimer cette ressource ?</h4>
                    <p class="text-muted mb-0">
                        Tu es sur le point de supprimer <span id="delete-resource-name" class="fw-semibold text-dark"></span>.
                        Cette action est definitive.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete-resource">Oui, supprimer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filtersForm = document.getElementById('resources-filters-form');
            const searchInput = document.getElementById('search');
            const categoryInput = document.getElementById('categorie');
            const modalElement = document.getElementById('deleteResourceModal');
            let searchTimeout;

            if (searchInput && filtersForm) {
                searchInput.addEventListener('input', function () {
                    window.clearTimeout(searchTimeout);
                    searchTimeout = window.setTimeout(function () {
                        filtersForm.submit();
                    }, 400);
                });
            }

            if (categoryInput && filtersForm) {
                categoryInput.addEventListener('change', function () {
                    filtersForm.submit();
                });
            }

            if (!modalElement || !window.bootstrap) {
                return;
            }

            const deleteModal = new bootstrap.Modal(modalElement);
            const resourceName = document.getElementById('delete-resource-name');
            const confirmButton = document.getElementById('confirm-delete-resource');
            let currentForm = null;

            document.querySelectorAll('.delete-resource-button').forEach(function (button) {
                button.addEventListener('click', function () {
                    currentForm = button.closest('.delete-resource-form');
                    resourceName.textContent = currentForm?.dataset.resourceTitle || 'cette ressource';
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
                resourceName.textContent = '';
            });
        });
    </script>
@endpush
