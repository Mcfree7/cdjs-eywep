@extends('admin.layouts.admin')

@push('styles')
    <style>
        .projects-header {
            background: #fff; padding: 1.2rem 1.5rem;
            border-radius: 1rem; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .projects-title h3 { font-family: inherit; font-weight: 600; font-size: 1.25rem; color: #212529; }
        .projects-subtitle { font-family: inherit; }

        .project-cover { width: 100%; height: 240px; object-fit: cover; border-radius: 0.75rem; }

        .delete-modal .modal-content { border: 0; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 1.5rem 3rem rgba(15, 23, 42, 0.2); }
        .delete-modal .modal-header { border-bottom: 0; padding: 1.25rem 1.25rem 0.5rem; }
        .delete-modal .modal-body { padding: 0.5rem 1.25rem 1rem; }
        .delete-modal .modal-footer { border-top: 0; padding: 0 1.25rem 1.25rem; }
        .delete-modal-icon {
            width: 4rem; height: 4rem; border-radius: 1rem;
            display: flex; align-items: center; justify-content: center;
            background: rgba(220, 53, 69, 0.12); color: #dc3545; font-size: 1.75rem;
        }

        .candidature-filters {
            display: grid; gap: 0.75rem;
        }
        @media (min-width: 768px) {
            .candidature-filters {
                grid-template-columns: minmax(0, 1fr) minmax(160px, 200px) auto;
                align-items: end;
            }
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="projects-header d-flex justify-content-between align-items-center flex-wrap">
            <div class="projects-title">
                <h3 class="mb-0">{{ $project->titre }}</h3>
                <span class="projects-subtitle">Détail du projet</span>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning shadow-sm">Modifier</a>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary shadow-sm">Retour</a>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projets</a></li>
                    <li class="breadcrumb-item active">Détail</li>
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

            <div class="row g-4">
                <!-- Infos projet -->
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            @if ($project->coverImage)
                                <img src="{{ asset('storage/' . $project->coverImage->image_path) }}" alt="{{ $project->titre }}" class="project-cover mb-3">
                            @endif

                            <div class="mb-3">
                                @php
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
                                <span class="badge {{ $statutClass }} fs-6">{{ $statutLabel }}</span>
                            </div>

                            <h5 class="fw-semibold mb-1">{{ $project->titre }}</h5>
                            <p class="text-muted small mb-1">
                                Publication : {{ $project->datePublication ? $project->datePublication->format('d/m/Y') : 'Non définie' }}
                            </p>
                            @if ($project->date_cloture)
                            @php
                                $isExpired  = $project->date_cloture->isPast();
                                $daysLeft   = (int) now()->diffInDays($project->date_cloture, false);
                                $urgentClass = $isExpired ? 'text-danger' : ($daysLeft <= 7 ? 'text-warning' : 'text-muted');
                            @endphp
                            <p class="small mb-3 {{ $urgentClass }} fw-semibold">
                                Clôture : {{ $project->date_cloture->format('d/m/Y') }}
                                @if ($isExpired)
                                    <span class="badge text-bg-danger ms-1">Expiré</span>
                                @elseif ($daysLeft <= 7)
                                    <span class="badge text-bg-warning ms-1">{{ $daysLeft }}j restants</span>
                                @endif
                            </p>
                            @else
                            <p class="text-muted small mb-3">Clôture : Non définie</p>
                            @endif

                            <div class="border-top pt-3">
                                <p class="mb-0" style="white-space: pre-line;">{{ strip_tags($project->description) }}</p>
                            </div>

                            @if ($project->images->count() > 1)
                                <div class="mt-3 border-top pt-3">
                                    <p class="fw-semibold small mb-2">Toutes les images</p>
                                    <div class="row g-2">
                                        @foreach ($project->images as $image)
                                            <div class="col-4">
                                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Image" class="img-thumbnail" style="width: 100%; height: 60px; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Candidatures -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <h5 class="mb-0">Candidatures <span class="badge text-bg-primary ms-1">{{ $candidatures->total() }}</span></h5>
                            <a href="{{ route('admin.candidatures.index', ['project_id' => $project->id]) }}" class="btn btn-sm btn-outline-primary">
                                Voir toutes les candidatures
                            </a>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Candidat</th>
                                        <th>Email</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                        <th style="width: 120px">Actions</th>
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
                                            <td class="fw-semibold">{{ $candidature->prenom }} {{ $candidature->nom }}</td>
                                            <td>{{ $candidature->email }}</td>
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
                                            <td colspan="5" class="text-center py-4">Aucune candidature pour ce projet.</td>
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
