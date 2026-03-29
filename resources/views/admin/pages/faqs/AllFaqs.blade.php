@extends('admin.layouts.admin')

@push('styles')
    <style>
        .faqs-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .faqs-header h3 {
            font-weight: 600;
            font-size: 1.25rem;
            color: #212529;
        }
        .faqs-filters {
            display: grid;
            gap: 0.75rem;
        }
        @media (min-width: 768px) {
            .faqs-filters {
                grid-template-columns: minmax(0, 1fr) auto;
                align-items: end;
            }
        }
        .delete-modal .modal-content {
            border: 0;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 1.5rem 3rem rgba(15, 23, 42, 0.2);
        }
        .delete-modal .modal-header { border-bottom: 0; padding: 1.25rem 1.25rem 0.5rem; }
        .delete-modal .modal-body   { padding: 0.5rem 1.25rem 1rem; }
        .delete-modal .modal-footer { border-top: 0; padding: 0 1.25rem 1.25rem; }
        .delete-modal-icon {
            width: 4rem; height: 4rem; border-radius: 1rem;
            display: flex; align-items: center; justify-content: center;
            background: rgba(220, 53, 69, 0.12); color: #dc3545; font-size: 1.75rem;
        }
        .faq-reponse-preview {
            max-width: 400px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #6c757d;
            font-size: .875rem;
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="faqs-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h3 class="mb-0">FAQ</h3>
                    <span class="text-muted small">Gestion des questions fréquentes</span>
                </div>
                <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary shadow-sm">
                    Nouvelle question
                </a>
            </div>
            <div class="row mt-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <form id="faqs-filters-form" action="{{ route('admin.faqs.index') }}" method="GET" class="faqs-filters">
                        <div>
                            <label for="search" class="form-label mb-1">Recherche</label>
                            <input type="text" id="search" name="search" class="form-control"
                                   value="{{ request('search') }}" placeholder="Mot-clé dans la question...">
                        </div>
                        <div>
                            <label class="form-label mb-1 d-block">&nbsp;</label>
                            <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width:60px">#</th>
                                <th style="width:60px">Ordre</th>
                                <th>Question</th>
                                <th>Réponse</th>
                                <th style="width:90px">Statut</th>
                                <th style="width:160px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($faqs as $faq)
                                <tr>
                                    <td>{{ $faq->id }}</td>
                                    <td class="text-center">{{ $faq->ordre }}</td>
                                    <td class="fw-semibold">{{ $faq->question }}</td>
                                    <td><div class="faq-reponse-preview">{{ $faq->reponse }}</div></td>
                                    <td>
                                        @if ($faq->actif)
                                            <span class="badge text-bg-success">Actif</span>
                                        @else
                                            <span class="badge text-bg-secondary">Inactif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.faqs.show', $faq) }}" class="btn btn-sm btn-info" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-warning" title="Modifier">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST"
                                                  class="delete-faq-form" data-faq-question="{{ $faq->question }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger delete-faq-button" title="Supprimer">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Aucune question disponible pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($faqs->hasPages())
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-center">
                            {{ $faqs->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade delete-modal" id="deleteFaqModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="delete-modal-icon"><i class="bi bi-trash3"></i></div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h4 class="mb-2">Supprimer cette question ?</h4>
                    <p class="text-muted mb-0">
                        Tu es sur le point de supprimer <span id="delete-faq-question" class="fw-semibold text-dark"></span>.
                        Cette action est définitive.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete-faq">Oui, supprimer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filtersForm = document.getElementById('faqs-filters-form');
            const searchInput = document.getElementById('search');
            const modalElement = document.getElementById('deleteFaqModal');
            let searchTimeout;

            if (searchInput && filtersForm) {
                searchInput.addEventListener('input', function () {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(function () { filtersForm.submit(); }, 400);
                });
            }

            if (!modalElement || !window.bootstrap) return;

            const deleteModal = new bootstrap.Modal(modalElement);
            const faqQuestion = document.getElementById('delete-faq-question');
            const confirmButton = document.getElementById('confirm-delete-faq');
            let currentForm = null;

            document.querySelectorAll('.delete-faq-button').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    currentForm = btn.closest('.delete-faq-form');
                    faqQuestion.textContent = currentForm?.dataset.faqQuestion || 'cette question';
                    deleteModal.show();
                });
            });

            confirmButton.addEventListener('click', function () {
                if (currentForm) currentForm.submit();
            });

            modalElement.addEventListener('hidden.bs.modal', function () {
                currentForm = null;
                faqQuestion.textContent = '';
            });
        });
    </script>
@endpush
