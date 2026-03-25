@extends('admin.layouts.admin')

@push('styles')
    <style>
        .galleries-toolbar {
            display: grid;
            gap: 1rem;
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

        @media (min-width: 992px) {
            .galleries-toolbar {
                grid-template-columns: minmax(0, 1fr) auto;
                align-items: end;
            }
        }

        .galleries-filters {
            display: grid;
            gap: 0.75rem;
        }

        @media (min-width: 768px) {
            .galleries-filters {
                grid-template-columns: minmax(0, 1fr) auto auto;
                align-items: end;
            }
        }

        .gallery-cover {
            width: 76px;
            height: 76px;
            border-radius: 0.9rem;
            object-fit: cover;
            background: #eef2f7;
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

        <div class="galleries-header d-flex justify-content-between align-items-center flex-wrap">

            <!-- LEFT -->
            <div class="galleries-title">
                <h3 class="mb-0">Liste des galeries</h3>
                <span class="galleries-subtitle">Gestion et suivi des galeries</span>
            </div>

            <!-- RIGHT -->
            <div>
                <a href="{{ route('galleries.create') }}" class="btn btn-primary shadow-sm">
                    Nouvelle galerie
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
                    <li class="breadcrumb-item active">Galeries</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <form id="galleries-filters-form" action="{{ route('galleries.index') }}" method="GET" class="galleries-filters">
                        <div>
                            <label for="search" class="form-label mb-1">Recherche</label>
                            <input
                                type="text"
                                id="search"
                                name="search"
                                class="form-control"
                                value="{{ request('search') }}"
                                placeholder="Titre de la galerie..."
                            >
                        </div>
                        <div>
                            @php
                                $direction = request('direction', 'desc');
                                $toggleDirection = $direction === 'asc' ? 'desc' : 'asc';
                                $directionLabel = $direction === 'asc' ? 'Plus ancien d abord' : 'Plus recent d abord';
                            @endphp
                            <label class="form-label mb-1 d-block">Ordre</label>
                            <a href="{{ route('galleries.index', array_merge(request()->query(), ['direction' => $toggleDirection])) }}" class="btn btn-outline-primary">
                                <i class="bi {{ $direction === 'asc' ? 'bi-sort-down' : 'bi-sort-up' }}"></i>
                                {{ $directionLabel }}
                            </a>
                        </div>
                        <div>
                            <label class="form-label mb-1 d-block">&nbsp;</label>
                            <a href="{{ route('galleries.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 80px">#</th>
                                <th>Apercu</th>
                                <th>Titre</th>
                                <th>Medias</th>
                                <th style="width: 160px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($galleries as $gallery)
                                @php
                                    $coverMedia = $gallery->medias->first();
                                    $coverUrl = $coverMedia
                                        ? (\Illuminate\Support\Str::startsWith($coverMedia->media_path, ['http://', 'https://'])
                                            ? $coverMedia->media_path
                                            : asset('storage/' . $coverMedia->media_path))
                                        : null;
                                    $videosCount = $gallery->medias->where('media_type', 'video')->count();
                                @endphp
                                <tr>
                                    <td>{{ $gallery->id }}</td>
                                    <td>
                                        @if ($coverMedia && $coverUrl)
                                            @if ($coverMedia->media_type === 'video')
                                                <video class="gallery-cover" muted playsinline>
                                                    <source src="{{ $coverUrl }}">
                                                </video>
                                            @else
                                                <img src="{{ $coverUrl }}" alt="{{ $gallery->titre }}" class="gallery-cover">
                                            @endif
                                        @else
                                            <div class="gallery-cover d-flex align-items-center justify-content-center text-muted">
                                                <i class="bi bi-images fs-4"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="fw-semibold">{{ $gallery->titre }}</td>
                                    <td>
                                        <span class="badge text-bg-primary">{{ $gallery->medias->count() }} media(s)</span>
                                        @if ($videosCount > 0)
                                            <span class="badge text-bg-dark">{{ $videosCount }} video(s)</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('galleries.show', $gallery) }}" class="btn btn-sm btn-info" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('galleries.edit', $gallery) }}" class="btn btn-sm btn-warning" title="Modifier">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('galleries.destroy', $gallery) }}" method="POST" class="delete-gallery-form" data-gallery-title="{{ $gallery->titre }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger delete-gallery-button" title="Supprimer">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">Aucune galerie disponible pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($galleries->hasPages())
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-center">
                            {{ $galleries->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade delete-modal" id="deleteGalleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="delete-modal-icon">
                        <i class="bi bi-trash3"></i>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="mb-2">Supprimer cette galerie ?</h4>
                    <p class="text-muted mb-0">
                        Tu es sur le point de supprimer <span id="delete-gallery-name" class="fw-semibold text-dark"></span>.
                        Cette action est definitive.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete-gallery">Oui, supprimer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filtersForm = document.getElementById('galleries-filters-form');
            const searchInput = document.getElementById('search');
            const modalElement = document.getElementById('deleteGalleryModal');
            let searchTimeout;

            if (searchInput && filtersForm) {
                searchInput.addEventListener('input', function () {
                    window.clearTimeout(searchTimeout);
                    searchTimeout = window.setTimeout(function () {
                        filtersForm.submit();
                    }, 400);
                });
            }

            if (!modalElement || !window.bootstrap) {
                return;
            }

            const deleteModal = new bootstrap.Modal(modalElement);
            const galleryName = document.getElementById('delete-gallery-name');
            const confirmButton = document.getElementById('confirm-delete-gallery');
            let currentForm = null;

            document.querySelectorAll('.delete-gallery-button').forEach(function (button) {
                button.addEventListener('click', function () {
                    currentForm = button.closest('.delete-gallery-form');
                    galleryName.textContent = currentForm?.dataset.galleryTitle || 'cette galerie';
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
                galleryName.textContent = '';
            });
        });
    </script>
@endpush
