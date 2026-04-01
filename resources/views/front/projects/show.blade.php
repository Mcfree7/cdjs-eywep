@php
    use App\Support\Countries;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp
@extends('front.layouts.app')

@section('title', $project->titre . ' - ' . ($settings->company_name ?? 'EYWEP'))
@section('description', Str::limit(strip_tags($project->description), 160))

@section('content')
<main>

    @include('front.partials.page-banner', [
        'bannerTitle'      => $project->titre,
        'breadcrumbParent' => ['label' => 'Projets', 'url' => route('front.projects.index')],
    ])

    <section class="page-project-details mt-100 section-padding">
        <div class="container">

            {{-- Flash messages --}}
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 radius18" role="alert">
                <strong>Succès !</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4 radius18" role="alert">
                <strong>Erreur !</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
            @endif

            <div class="row g-5">

                {{-- ============================================================
                     LEFT COLUMN: Project content
                ============================================================ --}}
                <div class="col-12 col-lg-7">

                    {{-- Cover image --}}
                    @if ($project->coverImage)
                    <div class="mb-5">
                        <img
                            src="{{ Storage::url($project->coverImage->image_path) }}"
                            alt="{{ $project->titre }}"
                            class="img-fluid radius18 w-100"
                            style="max-height: 480px; object-fit: cover;"
                        >
                    </div>
                    @endif

                    {{-- Title & meta --}}
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                        @if ($project->statut === 'ouvert')
                            <span class="badge bg-success" style="font-size:14px; padding: 6px 14px;">Ouvert</span>
                        @elseif ($project->statut === 'ferme')
                            <span class="badge bg-danger" style="font-size:14px; padding: 6px 14px;">Fermé</span>
                        @else
                            <span class="badge bg-secondary" style="font-size:14px; padding: 6px 14px;">Archivé</span>
                        @endif
                        @if ($project->datePublication)
                        <span class="text text-14 text-muted">
                            Publié le {{ $project->datePublication->format('d/m/Y') }}
                        </span>
                        @endif
                    </div>

                    <h1 class="heading text-50 fw-700 mb-4">{{ $project->titre }}</h1>

                    {{-- Description (HTML) --}}
                    <div class="text text-18 article-body mb-5">
                        {!! $project->description !!}
                    </div>

                    {{-- Project image gallery --}}
                    @if ($project->images && $project->images->isNotEmpty())
                    <div class="mt-5 pt-4" style="border-top: 1px solid rgba(0,0,0,0.08);">
                        <h2 class="heading text-30 fw-700 mb-4">Photos du projet</h2>
                        <div class="row g-3">
                            @foreach ($project->images as $image)
                            <div class="col-6 col-md-4">
                                <a
                                    href="{{ Storage::url($image->image_path) }}"
                                    target="_blank"
                                    rel="noopener"
                                    aria-label="Voir l'image en taille réelle"
                                >
                                    <img
                                        src="{{ Storage::url($image->image_path) }}"
                                        alt="{{ $project->titre }}"
                                        loading="lazy"
                                        class="img-fluid radius18 w-100"
                                        style="aspect-ratio: 4/3; object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.03)'"
                                        onmouseout="this.style.transform='scale(1)'"
                                    >
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>

                {{-- ============================================================
                     RIGHT COLUMN: Project info + Application form
                ============================================================ --}}
                <div class="col-12 col-lg-5">

                    {{-- Project info widget --}}
                    <div class="sidebar-widget project-info radius18 p-4 mb-4" style="border: 1px solid rgba(0,0,0,0.08); background: #fff;">
                        <h3 class="heading text-22 fw-700 mb-4">Informations du projet</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px solid rgba(0,0,0,0.06);">
                                <span class="text text-16 fw-600">Statut</span>
                                @if ($project->statut === 'ouvert')
                                    <span class="badge bg-success">Ouvert</span>
                                @elseif ($project->statut === 'ferme')
                                    <span class="badge bg-danger">Fermé</span>
                                @else
                                    <span class="badge bg-secondary">Archivé</span>
                                @endif
                            </li>
                            @if ($project->datePublication)
                            <li class="d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px solid rgba(0,0,0,0.06);">
                                <span class="text text-16 fw-600">Date de publication</span>
                                <span class="text text-16">{{ $project->datePublication->format('d/m/Y') }}</span>
                            </li>
                            @endif
                            @if ($project->date_cloture)
                            @php
                                $isExpired = $project->date_cloture->isPast();
                                $daysLeft  = (int) now()->diffInDays($project->date_cloture, false);
                            @endphp
                            <li class="d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px solid rgba(0,0,0,0.06);">
                                <span class="text text-16 fw-600">Date de clôture</span>
                                <span class="text text-16 d-flex align-items-center gap-2">
                                    {{ $project->date_cloture->format('d/m/Y') }}
                                    @if ($isExpired)
                                        <span class="badge bg-danger" style="font-size:11px;">Expiré</span>
                                    @elseif ($daysLeft <= 7)
                                        <span class="badge bg-warning text-dark" style="font-size:11px;">{{ $daysLeft }}j</span>
                                    @endif
                                </span>
                            </li>
                            @endif
                            <li class="d-flex justify-content-between align-items-center py-3" @if(!$project->tdr_path) style="border-bottom: none;" @endif>
                                <span class="text text-16 fw-600">Candidatures reçues</span>
                                <span class="text text-16 fw-700" style="color: var(--color-primary, #1c2539);">
                                    {{ $candidaturesCount ?? 0 }}
                                </span>
                            </li>
                            @if ($project->tdr_path)
                            <li class="py-3" style="border-top: 1px solid rgba(0,0,0,0.06);">
                                <a
                                    href="{{ Storage::url($project->tdr_path) }}"
                                    target="_blank"
                                    rel="noopener"
                                    class="button button--secondary w-100 justify-content-center"
                                    style="font-size: 14px;"
                                >
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="flex-shrink:0;">
                                        <path d="M12 16L7 11l1.4-1.45 2.6 2.6V4h2v8.15l2.6-2.6L17 11l-5 5zm-6 4v-2h12v2H6z" fill="currentColor"/>
                                    </svg>
                                    Télécharger les TDR
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>

                    {{-- Application form (ouvert) or closed message --}}
                    @if ($project->statut === 'ouvert')

                    <div class="sidebar-widget radius18 p-4" style="border: 1px solid rgba(0,0,0,0.08); background: #fff;">
                        <h3 class="heading text-22 fw-700 mb-2">Postuler à ce projet</h3>
                        <p class="text text-16 text-muted mb-4">Remplissez le formulaire ci-dessous pour soumettre votre candidature.</p>

                        {{-- Validation errors --}}
                        @if ($errors->any())
                        <div class="alert alert-danger radius18 mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li class="text text-14">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form
                            id="candidature-form"
                            action="{{ route('front.projects.apply', $project) }}"
                            method="POST"
                            enctype="multipart/form-data"
                            novalidate
                        >
                            @csrf

                            {{-- Nom / Prénom --}}
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-sm-6">
                                    <label for="nom" class="form-label text text-14 fw-600">Nom <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        class="form-control radius18 @error('nom') is-invalid @enderror"
                                        id="nom" name="nom"
                                        value="{{ old('nom') }}"
                                        placeholder="Votre nom"
                                        required
                                    >
                                    @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="prenom" class="form-label text text-14 fw-600">Prénom <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        class="form-control radius18 @error('prenom') is-invalid @enderror"
                                        id="prenom" name="prenom"
                                        value="{{ old('prenom') }}"
                                        placeholder="Votre prénom"
                                        required
                                    >
                                    @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            {{-- Pays / Sexe --}}
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-sm-6">
                                    <label for="pays" class="form-label text text-14 fw-600">Pays</label>
                                    <select
                                        class="form-select radius18 @error('pays') is-invalid @enderror"
                                        id="pays" name="pays"
                                    >
                                        <option value="">-- Sélectionner --</option>
                                        @foreach (Countries::list() as $code => $name)
                                            <option value="{{ $name }}" {{ old('pays') === $name ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pays')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="sexe" class="form-label text text-14 fw-600">Sexe</label>
                                    <select
                                        class="form-select radius18 @error('sexe') is-invalid @enderror"
                                        id="sexe" name="sexe"
                                    >
                                        <option value="">-- Sélectionner --</option>
                                        <option value="homme" {{ old('sexe') === 'homme' ? 'selected' : '' }}>Homme</option>
                                        <option value="femme" {{ old('sexe') === 'femme' ? 'selected' : '' }}>Femme</option>
                                        <option value="autre" {{ old('sexe') === 'autre' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                    @error('sexe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label text text-14 fw-600">Adresse e-mail <span class="text-danger">*</span></label>
                                <input
                                    type="email"
                                    class="form-control radius18 @error('email') is-invalid @enderror"
                                    id="email" name="email"
                                    value="{{ old('email') }}"
                                    placeholder="votre@email.com"
                                    required
                                >
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Téléphone --}}
                            <div class="mb-3">
                                <label for="telephone" class="form-label text text-14 fw-600">Numéro de téléphone</label>
                                <input
                                    type="tel"
                                    class="form-control radius18 @error('telephone') is-invalid @enderror"
                                    id="telephone" name="telephone"
                                    value="{{ old('telephone') }}"
                                    placeholder="+226 XX XX XX XX"
                                >
                                @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Lettre de motivation (PDF) --}}
                            <div class="mb-3">
                                <label for="lettre_motivation" class="form-label text text-14 fw-600">
                                    Lettre de motivation <span class="text-danger">*</span>
                                    <span class="text text-12 fw-400" style="color:var(--color-foreground-subheading);">(PDF, max 5 Mo)</span>
                                </label>
                                <input
                                    type="file"
                                    class="form-control radius18 @error('lettre_motivation') is-invalid @enderror"
                                    id="lettre_motivation" name="lettre_motivation"
                                    accept=".pdf,application/pdf"
                                    required
                                >
                                @error('lettre_motivation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Pièce d'identité (PDF) --}}
                            <div class="mb-3">
                                <label for="piece_identite" class="form-label text text-14 fw-600">
                                    Pièce d'identité <span class="text-danger">*</span>
                                    <span class="text text-12 fw-400" style="color:var(--color-foreground-subheading);">(PDF, max 5 Mo)</span>
                                </label>
                                <input
                                    type="file"
                                    class="form-control radius18 @error('piece_identite') is-invalid @enderror"
                                    id="piece_identite" name="piece_identite"
                                    accept=".pdf,application/pdf"
                                    required
                                >
                                @error('piece_identite')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- CV --}}
                            <div class="mb-4">
                                <label for="cv" class="form-label text text-14 fw-600">
                                    CV <span class="text-danger">*</span>
                                    <span class="text text-12 fw-400" style="color:var(--color-foreground-subheading);">(PDF, DOC ou DOCX, max 5 Mo)</span>
                                </label>
                                <input
                                    type="file"
                                    class="form-control radius18 @error('cv') is-invalid @enderror"
                                    id="cv" name="cv"
                                    accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                    required
                                >
                                @error('cv')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="button button--primary w-100 justify-content-center">
                                Envoyer ma candidature
                                <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                                </svg>
                            </button>

                        </form>
                    </div>

                    @else

                    {{-- Candidatures closed --}}
                    <div class="sidebar-widget service-contact radius18 p-4 text-center" style="border: 1px solid rgba(0,0,0,0.08); background: #fff;">
                        <div class="mb-3" style="font-size: 48px; line-height:1;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color: #6c757d;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                            </svg>
                        </div>
                        <h3 class="heading text-22 fw-700 mb-3">Candidatures fermées</h3>
                        <p class="text text-18 text-muted mb-4">
                            @if ($project->statut === 'ferme')
                                Les candidatures pour ce projet sont actuellement fermées. Consultez nos autres projets ouverts.
                            @else
                                Ce projet est archivé. Les candidatures ne sont plus acceptées.
                            @endif
                        </p>
                        <a href="{{ route('front.projects.index') }}" class="button button--secondary">
                            Voir les autres projets
                            <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                            </svg>
                        </a>
                    </div>

                    @endif

                </div>
                {{-- end right column --}}

            </div>
        </div>
    </section>

</main>
@endsection
