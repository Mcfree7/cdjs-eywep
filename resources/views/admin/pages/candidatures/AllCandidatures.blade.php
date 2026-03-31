@extends('admin.layouts.admin')

@push('styles')
    <style>
        .candidatures-header {
            background: #fff; padding: 1.2rem 1.5rem;
            border-radius: 1rem; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .candidatures-title h3 { font-family: inherit; font-weight: 600; font-size: 1.25rem; color: #212529; }
        .candidatures-subtitle { font-family: inherit; }

        .candidatures-filters {
            display: grid; gap: 0.75rem;
        }
        @media (min-width: 768px) {
            .candidatures-filters {
                grid-template-columns: minmax(0, 1.2fr) minmax(180px, 240px) minmax(160px, 200px) auto;
                align-items: end;
            }
        }

        .sortable-link { color: inherit; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem; }
        .sortable-link:hover { color: inherit; }
        .sortable-link i { font-size: 0.8rem; opacity: 0.65; }

        .delete-modal .modal-content { border: 0; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 1.5rem 3rem rgba(15, 23, 42, 0.2); }
        .delete-modal .modal-header { border-bottom: 0; padding: 1.25rem 1.25rem 0.5rem; }
        .delete-modal .modal-body { padding: 0.5rem 1.25rem 1rem; }
        .delete-modal .modal-footer { border-top: 0; padding: 0 1.25rem 1.25rem; }
        .delete-modal-icon {
            width: 4rem; height: 4rem; border-radius: 1rem;
            display: flex; align-items: center; justify-content: center;
            background: rgba(220, 53, 69, 0.12); color: #dc3545; font-size: 1.75rem;
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="candidatures-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="candidatures-title">
                <h3 class="mb-0">Liste des candidatures</h3>
                <span class="candidatures-subtitle">Gestion de toutes les candidatures</span>
            </div>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exportStatsModal">
                <i class="bi bi-bar-chart-line me-1"></i> Rapport statistiques
            </button>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Candidatures</li>
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
                    <form id="candidatures-filters-form" action="{{ route('admin.candidatures.index') }}" method="GET" class="candidatures-filters">
                        <div>
                            <label for="search" class="form-label mb-1">Recherche</label>
                            <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Nom, prenom ou email...">
                        </div>
                        <div>
                            <label for="project_id" class="form-label mb-1">Projet</label>
                            <select id="project_id" name="project_id" class="form-select">
                                <option value="">Tous les projets</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>{{ $project->titre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="statut" class="form-label mb-1">Statut</label>
                            <select id="statut" name="statut" class="form-select">
                                <option value="">Tous</option>
                                <option value="en_attente" {{ request('statut') === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="retenue" {{ request('statut') === 'retenue' ? 'selected' : '' }}>Retenue</option>
                                <option value="rejetee" {{ request('statut') === 'rejetee' ? 'selected' : '' }}>Rejetee</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label mb-1 d-block">&nbsp;</label>
                            <a href="{{ route('admin.candidatures.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    @php
                        $currentSort = request('sort', 'id');
                        $currentDirection = request('direction', 'desc');

                        $sortUrl = function (string $column) use ($currentSort, $currentDirection) {
                            $direction = $currentSort === $column && $currentDirection === 'asc' ? 'desc' : 'asc';
                            return route('admin.candidatures.index', array_merge(request()->query(), [
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
                                    <a href="{{ $sortUrl('id') }}" class="sortable-link"><span>#</span><i class="bi {{ $sortIcon('id') }}"></i></a>
                                </th>
                                <th>
                                    <a href="{{ $sortUrl('nom') }}" class="sortable-link"><span>Candidat</span><i class="bi {{ $sortIcon('nom') }}"></i></a>
                                </th>
                                <th>
                                    <a href="{{ $sortUrl('email') }}" class="sortable-link"><span>Email</span><i class="bi {{ $sortIcon('email') }}"></i></a>
                                </th>
                                <th>Projet</th>
                                <th>
                                    <a href="{{ $sortUrl('statut') }}" class="sortable-link"><span>Statut</span><i class="bi {{ $sortIcon('statut') }}"></i></a>
                                </th>
                                <th>
                                    <a href="{{ $sortUrl('created_at') }}" class="sortable-link"><span>Date</span><i class="bi {{ $sortIcon('created_at') }}"></i></a>
                                </th>
                                <th style="width: 100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($candidatures as $candidature)
                                @php
                                    $cStatutClass = match($candidature->statut) {
                                        'en_attente' => 'text-bg-secondary',
                                        'retenue'    => 'text-bg-success',
                                        'rejetee'    => 'text-bg-danger',
                                        default      => 'text-bg-secondary',
                                    };
                                    $cStatutLabel = match($candidature->statut) {
                                        'en_attente' => 'En attente',
                                        'retenue'    => 'Retenue',
                                        'rejetee'    => 'Rejetee',
                                        default      => $candidature->statut,
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $candidature->id }}</td>
                                    <td class="fw-semibold">{{ $candidature->prenom }} {{ $candidature->nom }}</td>
                                    <td>{{ $candidature->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.projects.show', $candidature->project) }}" class="text-decoration-none">
                                            {{ \Illuminate\Support\Str::limit($candidature->project->titre, 40) }}
                                        </a>
                                    </td>
                                    <td><span class="badge {{ $cStatutClass }}">{{ $cStatutLabel }}</span></td>
                                    <td>{{ $candidature->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.candidatures.show', $candidature) }}" class="btn btn-sm btn-info" title="Voir"><i class="bi bi-eye"></i></a>
                                            <form action="{{ route('admin.candidatures.destroy', $candidature) }}" method="POST" class="delete-candidature-form" data-name="{{ $candidature->prenom }} {{ $candidature->nom }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger delete-candidature-button" title="Supprimer"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">Aucune candidature disponible.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($candidatures->hasPages())
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-center">{{ $candidatures->links() }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal export statistiques --}}
    <div class="modal fade" id="exportStatsModal" tabindex="-1" aria-labelledby="exportStatsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 1.25rem; overflow: hidden;">
                <div class="modal-header border-0 pb-0">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:2.75rem;height:2.75rem;border-radius:.75rem;background:rgba(59,130,246,.12);color:#1d4ed8;display:flex;align-items:center;justify-content:center;font-size:1.4rem;">
                            <i class="bi bi-bar-chart-line"></i>
                        </div>
                        <div>
                            <h5 class="modal-title mb-0" id="exportStatsModalLabel">Exporter un rapport statistiques</h5>
                            <small class="text-muted">Choisissez vos filtres et le format d'export</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.candidatures.export-stats') }}" method="GET" id="export-stats-form">
                    <div class="modal-body pt-3">
                        <div class="mb-3">
                            <label for="export-project-id" class="form-label">Projet <span class="text-muted fw-normal">(optionnel)</span></label>
                            <select id="export-project-id" name="project_id" class="form-select">
                                <option value="">Tous les projets</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>{{ $project->titre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="export-pays" class="form-label">Pays <span class="text-muted fw-normal">(optionnel)</span></label>
                            <input type="text" id="export-pays" name="pays" class="form-control" placeholder="Ex : Côte d'Ivoire" value="{{ request('pays') }}">
                        </div>
                        <div>
                            <label class="form-label">Format d'export</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="format" id="format-pdf" value="pdf" checked>
                                    <label class="form-check-label" for="format-pdf">
                                        <i class="bi bi-filetype-pdf text-danger me-1"></i> PDF
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="format" id="format-excel" value="excel">
                                    <label class="form-check-label" for="format-excel">
                                        <i class="bi bi-file-earmark-spreadsheet text-success me-1"></i> Excel
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-download me-1"></i> Télécharger
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade delete-modal" id="deleteCandidatureModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="delete-modal-icon"><i class="bi bi-trash3"></i></div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h4 class="mb-2">Supprimer cette candidature ?</h4>
                    <p class="text-muted mb-0">Tu es sur le point de supprimer la candidature de <span id="delete-candidature-name" class="fw-semibold text-dark"></span>. Cette action est definitive.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete-candidature">Oui, supprimer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filtersForm = document.getElementById('candidatures-filters-form');
            const searchInput = document.getElementById('search');
            const projectSelect = document.getElementById('project_id');
            const statutSelect = document.getElementById('statut');
            let searchTimeout;

            if (searchInput && filtersForm) {
                searchInput.addEventListener('input', function () {
                    window.clearTimeout(searchTimeout);
                    searchTimeout = window.setTimeout(function () { filtersForm.submit(); }, 400);
                });
            }

            [projectSelect, statutSelect].forEach(function (select) {
                if (select && filtersForm) {
                    select.addEventListener('change', function () { filtersForm.submit(); });
                }
            });

            const modalElement = document.getElementById('deleteCandidatureModal');
            if (!modalElement || !window.bootstrap) return;

            const deleteModal = new bootstrap.Modal(modalElement);
            const candidatureName = document.getElementById('delete-candidature-name');
            const confirmButton = document.getElementById('confirm-delete-candidature');
            let currentForm = null;

            document.querySelectorAll('.delete-candidature-button').forEach(function (button) {
                button.addEventListener('click', function () {
                    currentForm = button.closest('.delete-candidature-form');
                    candidatureName.textContent = currentForm?.dataset.name || 'ce candidat';
                    deleteModal.show();
                });
            });

            confirmButton.addEventListener('click', function () {
                if (currentForm) currentForm.submit();
            });

            modalElement.addEventListener('hidden.bs.modal', function () {
                currentForm = null;
                candidatureName.textContent = '';
            });
        });
    </script>
@endpush
