@extends('admin.layouts.admin')

@push('styles')
    <style>
        .projects-toolbar {
            display: grid;
            gap: 1rem;
        }

        .projects-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .projects-title h3 {
            font-family: inherit;
            font-weight: 600;
            font-size: 1.25rem;
            color: #212529;
        }

        .projects-subtitle {
            font-family: inherit;
        }

        @media (min-width: 992px) {
            .projects-toolbar {
                grid-template-columns: minmax(0, 1fr) auto;
                align-items: end;
            }
        }

        .projects-filters {
            display: grid;
            gap: 0.75rem;
        }

        @media (min-width: 768px) {
            .projects-filters {
                grid-template-columns: minmax(0, 1.4fr) minmax(160px, 200px) minmax(160px, 200px) auto;
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

        .sortable-link:hover { color: inherit; }
        .sortable-link i { font-size: 0.8rem; opacity: 0.65; }

        .delete-modal .modal-content {
            border: 0;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 1.5rem 3rem rgba(15, 23, 42, 0.2);
        }

        .delete-modal .modal-header { border-bottom: 0; padding: 1.25rem 1.25rem 0.5rem; }
        .delete-modal .modal-body { padding: 0.5rem 1.25rem 1rem; }
        .delete-modal .modal-footer { border-top: 0; padding: 0 1.25rem 1.25rem; }

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

        <div class="projects-header d-flex justify-content-between align-items-center flex-wrap">
            <div class="projects-title">
                <h3 class="mb-0">Liste des projets</h3>
                <span class="projects-subtitle">Gestion et suivi des projets</span>
            </div>
            <div>
                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary shadow-sm">
                    Nouveau projet
                </a>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Projets</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <form id="projects-filters-form" action="{{ route('admin.projects.index') }}" method="GET" class="projects-filters">
                        <div>
                            <label for="search" class="form-label mb-1">Recherche</label>
                            <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Titre ou contenu...">
                        </div>
                        <div>
                            <label for="statut" class="form-label mb-1">Statut</label>
                            <select id="statut" name="statut" class="form-select">
                                <option value="">Tous</option>
                                <option value="ouvert" {{ request('statut') === 'ouvert' ? 'selected' : '' }}>Ouvert</option>
                                <option value="ferme" {{ request('statut') === 'ferme' ? 'selected' : '' }}>Ferme</option>
                                <option value="archive" {{ request('statut') === 'archive' ? 'selected' : '' }}>Archive</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label mb-1 d-block">&nbsp;</label>
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    @php
                        $currentSort = request('sort', 'id');
                        $currentDirection = request('direction', 'desc');

                        $sortUrl = function (string $column) use ($currentSort, $currentDirection) {
                            $direction = $currentSort === $column && $currentDirection === 'asc' ? 'desc' : 'asc';
                            return route('admin.projects.index', array_merge(request()->query(), [
                                'sort' => $column,
                                'direction' => $direction,
                            ]));
                        };

                        $sortIcon = function (string $column) use ($currentSort, $currentDirection) {
                            if ($currentSort !== $column) return 'bi-arrow-down-up';
                            return $currentDirection === 'asc' ? 'bi-sort-up' : 'bi-sort-down';
                        };
                    @endphp
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 70px">
                                    <a href="{{ $sortUrl('id') }}" class="sortable-link">
                                        <span>#</span><i class="bi {{ $sortIcon('id') }}"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ $sortUrl('titre') }}" class="sortable-link">
                                        <span>Titre</span><i class="bi {{ $sortIcon('titre') }}"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ $sortUrl('statut') }}" class="sortable-link">
                                        <span>Statut</span><i class="bi {{ $sortIcon('statut') }}"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ $sortUrl('datePublication') }}" class="sortable-link">
                                        <span>Date</span><i class="bi {{ $sortIcon('datePublication') }}"></i>
                                    </a>
                                </th>
                                <th>Candidatures</th>
                                <th>Image</th>
                                <th style="width: 160px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projects as $project)
                                @php
                                    $imagePath = $project->coverImage?->image_path;
                                    $imageUrl = $imagePath ? asset('storage/' . $imagePath) : null;

                                    $statutClass = match($project->statut) {
                                        'ouvert'  => 'text-bg-success',
                                        'ferme'   => 'text-bg-warning',
                                        'archive' => 'text-bg-secondary',
                                        default   => 'text-bg-secondary',
                                    };
                                    $statutLabel = match($project->statut) {
                                        'ouvert'  => 'Ouvert',
                                        'ferme'   => 'Ferme',
                                        'archive' => 'Archive',
                                        default   => $project->statut,
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td class="fw-semibold">{{ $project->titre }}</td>
                                    <td><span class="badge {{ $statutClass }}">{{ $statutLabel }}</span></td>
                                    <td>{{ $project->datePublication ? $project->datePublication->format('d/m/Y') : 'Non definie' }}</td>
                                    <td>
                                        <a href="{{ route('admin.projects.show', $project) }}" class="badge text-bg-primary text-decoration-none">
                                            {{ $project->candidatures_count }} candidature(s)
                                        </a>
                                    </td>
                                    <td>
                                        @if ($imageUrl)
                                            <img src="{{ $imageUrl }}" alt="{{ $project->titre }}" class="img-thumbnail" style="width: 70px; height: 70px; object-fit: cover;">
                                        @else
                                            <span class="badge text-bg-secondary">Aucune image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-sm btn-info" title="Voir"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-warning" title="Modifier"><i class="bi bi-pencil-square"></i></a>
                                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="delete-project-form" data-project-title="{{ $project->titre }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger delete-project-button" title="Supprimer"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">Aucun projet disponible pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($projects->hasPages())
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-center">
                            {{ $projects->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade delete-modal" id="deleteProjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="delete-modal-icon"><i class="bi bi-trash3"></i></div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h4 class="mb-2">Supprimer ce projet ?</h4>
                    <p class="text-muted mb-0">Tu es sur le point de supprimer <span id="delete-project-name" class="fw-semibold text-dark"></span>. Toutes les candidatures associees seront egalement supprimees. Cette action est definitive.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete-project">Oui, supprimer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filtersForm = document.getElementById('projects-filters-form');
            const searchInput = document.getElementById('search');
            const statutSelect = document.getElementById('statut');
            const modalElement = document.getElementById('deleteProjectModal');
            let searchTimeout;

            if (searchInput && filtersForm) {
                searchInput.addEventListener('input', function () {
                    window.clearTimeout(searchTimeout);
                    searchTimeout = window.setTimeout(function () { filtersForm.submit(); }, 400);
                });
            }

            if (statutSelect && filtersForm) {
                statutSelect.addEventListener('change', function () { filtersForm.submit(); });
            }

            if (!modalElement || !window.bootstrap) return;

            const deleteModal = new bootstrap.Modal(modalElement);
            const projectName = document.getElementById('delete-project-name');
            const confirmButton = document.getElementById('confirm-delete-project');
            let currentForm = null;

            document.querySelectorAll('.delete-project-button').forEach(function (button) {
                button.addEventListener('click', function () {
                    currentForm = button.closest('.delete-project-form');
                    projectName.textContent = currentForm?.dataset.projectTitle || 'ce projet';
                    deleteModal.show();
                });
            });

            confirmButton.addEventListener('click', function () {
                if (currentForm) currentForm.submit();
            });

            modalElement.addEventListener('hidden.bs.modal', function () {
                currentForm = null;
                projectName.textContent = '';
            });
        });
    </script>
@endpush
