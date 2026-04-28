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
        'breadcrumbParent' => ['label' => __('app.apply.breadcrumb'), 'url' => route('front.projects.index')],
    ])

    <section class="page-project-details mt-100 section-padding">
        <div class="container">

            {{-- Flash messages --}}
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 radius18" role="alert">
                <strong>{{ __('app.flash.success') }}</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('app.apply.close_alert') }}"></button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4 radius18" role="alert">
                <strong>{{ __('app.flash.error') }}</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('app.apply.close_alert') }}"></button>
            </div>
            @endif

            <div class="row g-5">

                {{-- ── Colonne gauche : contenu du projet ── --}}
                <div class="col-12 col-lg-7">

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

                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                        @if ($project->statut === 'ouvert')
                            <span class="badge bg-success" style="font-size:14px; padding: 6px 14px;">{{ __('app.apply.status_open') }}</span>
                        @elseif ($project->statut === 'ferme')
                            <span class="badge bg-danger" style="font-size:14px; padding: 6px 14px;">{{ __('app.apply.status_closed') }}</span>
                        @else
                            <span class="badge bg-secondary" style="font-size:14px; padding: 6px 14px;">{{ __('app.apply.status_archived') }}</span>
                        @endif
                        @if ($project->datePublication)
                        <span class="text text-14 text-muted">
                            {{ __('app.apply.published_prefix') }} {{ $project->datePublication->format('d/m/Y') }}
                        </span>
                        @endif
                    </div>

                    <h1 class="heading text-50 fw-700 mb-4">{{ $project->titre }}</h1>

                    <div class="text text-18 article-body mb-5">
                        {!! $project->description !!}
                    </div>

                    @if ($project->images && $project->images->isNotEmpty())
                    <div class="mt-5 pt-4" style="border-top: 1px solid rgba(0,0,0,0.08);">
                        <h2 class="heading text-30 fw-700 mb-4">{{ __('app.apply.photos_title') }}</h2>
                        <div class="row g-3">
                            @foreach ($project->images as $image)
                            <div class="col-6 col-md-4">
                                <a
                                    href="{{ Storage::url($image->image_path) }}"
                                    target="_blank"
                                    rel="noopener"
                                    aria-label="{{ __('app.apply.view_image') }}"
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

                {{-- ── Colonne droite : infos + formulaire ── --}}
                <div class="col-12 col-lg-5">

                    {{-- Widget infos --}}
                    <div class="sidebar-widget project-info radius18 p-4 mb-4" style="border: 1px solid rgba(0,0,0,0.08); background: #fff;">
                        <h3 class="heading text-22 fw-700 mb-4">{{ __('app.apply.info_title') }}</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px solid rgba(0,0,0,0.06);">
                                <span class="text text-16 fw-600">{{ __('app.apply.status_label') }}</span>
                                @if ($project->statut === 'ouvert')
                                    <span class="badge bg-success">{{ __('app.apply.status_open') }}</span>
                                @elseif ($project->statut === 'ferme')
                                    <span class="badge bg-danger">{{ __('app.apply.status_closed') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __('app.apply.status_archived') }}</span>
                                @endif
                            </li>
                            @if ($project->datePublication)
                            <li class="d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px solid rgba(0,0,0,0.06);">
                                <span class="text text-16 fw-600">{{ __('app.apply.published_label') }}</span>
                                <span class="text text-16">{{ $project->datePublication->format('d/m/Y') }}</span>
                            </li>
                            @endif
                            @if ($project->date_cloture)
                            @php
                                $isExpired = $project->date_cloture->isPast();
                                $daysLeft  = (int) now()->diffInDays($project->date_cloture, false);
                            @endphp
                            <li class="d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px solid rgba(0,0,0,0.06);">
                                <span class="text text-16 fw-600">{{ __('app.apply.deadline_label') }}</span>
                                <span class="text text-16 d-flex align-items-center gap-2">
                                    {{ $project->date_cloture->format('d/m/Y') }}
                                    @if ($isExpired)
                                        <span class="badge bg-danger" style="font-size:11px;">{{ __('app.apply.deadline_expired') }}</span>
                                    @elseif ($daysLeft <= 7)
                                        <span class="badge bg-warning text-dark" style="font-size:11px;">{{ $daysLeft }}j</span>
                                    @endif
                                </span>
                            </li>
                            @endif
                            <li class="d-flex justify-content-between align-items-center py-3" @if(!$project->tdr_path) style="border-bottom: none;" @endif>
                                <span class="text text-16 fw-600">{{ __('app.apply.applications_label') }}</span>
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
                                    {{ __('app.apply.download_tdr') }}
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>

                    {{-- Formulaire de candidature --}}
                    @php $isOpen = $project->statut === 'ouvert'; @endphp

                    <div class="sidebar-widget radius18 p-4" style="border: 1px solid rgba(0,0,0,0.08); background: #fff;">

                        @if (!$isOpen)
                        <div class="d-flex align-items-center gap-3 rounded-3 mb-4 px-3 py-3" style="background: #fff3f3; border: 1px solid #f5c2c7;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#dc3545" stroke-width="1.8" style="flex-shrink:0;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                            </svg>
                            <div>
                                <div class="fw-700" style="color:#dc3545; font-size:14px;">{{ __('app.apply.closed_banner_title') }}</div>
                                <div class="text text-13 text-muted mt-1">
                                    @if ($project->date_cloture && $project->date_cloture->isPast())
                                        {{ __('app.apply.closed_expired', ['date' => $project->date_cloture->format('d/m/Y')]) }}
                                    @else
                                        {{ __('app.apply.closed_no_more') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                        <h3 class="heading text-22 fw-700 mb-2">{{ __('app.apply.form_title') }}</h3>
                        <p class="text text-16 text-muted mb-4">{{ __('app.apply.form_subtitle') }}</p>

                        @if ($errors->any())
                        <div class="alert alert-danger radius18 mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li class="text text-14">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div style="{{ !$isOpen ? 'opacity:.45; pointer-events:none; user-select:none;' : '' }}">
                        <form
                            id="candidature-form"
                            action="{{ route('front.projects.apply', $project) }}"
                            method="POST"
                            enctype="multipart/form-data"
                            novalidate
                            {{ !$isOpen ? 'inert' : '' }}
                        >
                            @csrf

                            {{-- Nom / Prénom --}}
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-sm-6">
                                    <label for="nom" class="form-label text text-14 fw-600">
                                        {{ __('app.apply.label_nom') }} <span class="text-danger">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control radius18 @error('nom') is-invalid @enderror"
                                        id="nom" name="nom"
                                        value="{{ old('nom') }}"
                                        placeholder="{{ __('app.apply.placeholder_nom') }}"
                                        required
                                    >
                                    @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="prenom" class="form-label text text-14 fw-600">
                                        {{ __('app.apply.label_prenom') }} <span class="text-danger">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control radius18 @error('prenom') is-invalid @enderror"
                                        id="prenom" name="prenom"
                                        value="{{ old('prenom') }}"
                                        placeholder="{{ __('app.apply.placeholder_prenom') }}"
                                        required
                                    >
                                    @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            {{-- Pays / Sexe --}}
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-sm-6">
                                    <label for="pays" class="form-label text text-14 fw-600">{{ __('app.apply.label_pays') }} <span class="text-danger">*</span></label>
                                    <select
                                        class="form-select radius18 @error('pays') is-invalid @enderror"
                                        id="pays" name="pays"
                                        required
                                    >
                                        <option value="">{{ __('app.apply.select_default') }}</option>
                                        @foreach (Countries::list() as $code => $name)
                                            <option value="{{ $name }}" {{ old('pays') === $name ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pays')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="sexe" class="form-label text text-14 fw-600">{{ __('app.apply.label_sexe') }} <span class="text-danger">*</span></label>
                                    <select
                                        class="form-select radius18 @error('sexe') is-invalid @enderror"
                                        id="sexe" name="sexe"
                                        required
                                    >
                                        <option value="">{{ __('app.apply.select_default') }}</option>
                                        <option value="homme" {{ old('sexe') === 'homme' ? 'selected' : '' }}>{{ __('app.apply.sexe_homme') }}</option>
                                        <option value="femme" {{ old('sexe') === 'femme' ? 'selected' : '' }}>{{ __('app.apply.sexe_femme') }}</option>
                                        <option value="autre" {{ old('sexe') === 'autre' ? 'selected' : '' }}>{{ __('app.apply.sexe_autre') }}</option>
                                    </select>
                                    @error('sexe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label text text-14 fw-600">
                                    {{ __('app.apply.label_email') }} <span class="text-danger">*</span>
                                </label>
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
                                <label for="telephone" class="form-label text text-14 fw-600">{{ __('app.apply.label_telephone') }}</label>
                                <input
                                    type="tel"
                                    class="form-control radius18 @error('telephone') is-invalid @enderror"
                                    id="telephone" name="telephone"
                                    value="{{ old('telephone') }}"
                                    placeholder="+226 XX XX XX XX"
                                >
                                @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Lettre de motivation --}}
                            <div class="mb-3">
                                <label for="lettre_motivation" class="form-label text text-14 fw-600">
                                    {{ __('app.apply.label_motivation') }} <span class="text-danger">*</span>
                                    <span class="text text-12 fw-400" style="color:var(--color-foreground-subheading);">{{ __('app.apply.label_motivation_hint') }}</span>
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

                            {{-- Pièce d'identité --}}
                            <div class="mb-3">
                                <label for="piece_identite" class="form-label text text-14 fw-600">
                                    {{ __('app.apply.label_identite') }} <span class="text-danger">*</span>
                                    <span class="text text-12 fw-400" style="color:var(--color-foreground-subheading);">{{ __('app.apply.label_identite_hint') }}</span>
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
                                    {{ __('app.apply.label_cv') }} <span class="text-danger">*</span>
                                    <span class="text text-12 fw-400" style="color:var(--color-foreground-subheading);">{{ __('app.apply.label_cv_hint') }}</span>
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

                            {{-- Documents complémentaires --}}
                            <div class="mt-2 mb-3 pt-3" style="border-top: 1px solid rgba(0,0,0,0.08);">
                                <p class="text text-14 fw-600 mb-1">{{ __('app.apply.section_docs') }}</p>
                                <p class="text text-12" style="color:var(--color-foreground-subheading);">{{ __('app.apply.section_docs_hint') }}</p>
                            </div>

                            {{-- Business plan simplifié --}}
                            <div class="mb-3">
                                <label for="business_plan" class="form-label text text-14 fw-600 d-flex align-items-center gap-2">
                                    {{ __('app.apply.label_business_plan') }} <span class="text-danger">*</span>
                                    <span class="text text-12 fw-400" style="color:var(--color-foreground-subheading);">{{ __('app.apply.label_pdf_hint') }}</span>
                                    <button type="button" class="btn btn-link p-0 ms-1 lh-1 apply-info-btn"
                                        data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-html="true"
                                        data-bs-placement="left"
                                        data-bs-content="{{ __('app.apply.tooltip_business_plan') }}"
                                        aria-label="{{ __('app.apply.tooltip_aria') }}"
                                    ><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--color-foreground-subheading);"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg></button>
                                </label>
                                <input
                                    type="file"
                                    class="form-control radius18 @error('business_plan') is-invalid @enderror"
                                    id="business_plan" name="business_plan"
                                    accept=".pdf,application/pdf"
                                    required
                                >
                                @error('business_plan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Plan financier prévisionnel --}}
                            <div class="mb-3">
                                <label for="plan_financier" class="form-label text text-14 fw-600 d-flex align-items-center gap-2">
                                    {{ __('app.apply.label_plan_financier') }} <span class="text-danger">*</span>
                                    <span class="text text-12 fw-400" style="color:var(--color-foreground-subheading);">{{ __('app.apply.label_pdf_hint') }}</span>
                                    <button type="button" class="btn btn-link p-0 ms-1 lh-1 apply-info-btn"
                                        data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-html="true"
                                        data-bs-placement="left"
                                        data-bs-content="{{ __('app.apply.tooltip_plan_financier') }}"
                                        aria-label="{{ __('app.apply.tooltip_aria') }}"
                                    ><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--color-foreground-subheading);"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg></button>
                                </label>
                                <input
                                    type="file"
                                    class="form-control radius18 @error('plan_financier') is-invalid @enderror"
                                    id="plan_financier" name="plan_financier"
                                    accept=".pdf,application/pdf"
                                    required
                                >
                                @error('plan_financier')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Documents légaux --}}
                            <div class="mb-3">
                                <label for="documents_legaux" class="form-label text text-14 fw-600 d-flex align-items-center gap-2">
                                    {{ __('app.apply.label_documents_legaux') }}
                                    <span class="text text-12 fw-400" style="color:var(--color-foreground-subheading);">{{ __('app.apply.label_pdf_hint') }}</span>
                                    <button type="button" class="btn btn-link p-0 ms-1 lh-1 apply-info-btn"
                                        data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-html="true"
                                        data-bs-placement="left"
                                        data-bs-content="{{ __('app.apply.tooltip_documents_legaux') }}"
                                        aria-label="{{ __('app.apply.tooltip_aria') }}"
                                    ><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--color-foreground-subheading);"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg></button>
                                </label>
                                <input
                                    type="file"
                                    class="form-control radius18 @error('documents_legaux') is-invalid @enderror"
                                    id="documents_legaux" name="documents_legaux"
                                    accept=".pdf,application/pdf"
                                >
                                @error('documents_legaux')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Autres activités --}}
                            <div class="mb-4">
                                <label for="autres_activites" class="form-label text text-14 fw-600 d-flex align-items-center gap-2">
                                    {{ __('app.apply.label_autres_activites') }}
                                    <span class="text text-12 fw-400" style="color:var(--color-foreground-subheading);">{{ __('app.apply.label_pdf_hint') }}</span>
                                    <button type="button" class="btn btn-link p-0 ms-1 lh-1 apply-info-btn"
                                        data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-html="true"
                                        data-bs-placement="left"
                                        data-bs-content="{{ __('app.apply.tooltip_autres_activites') }}"
                                        aria-label="{{ __('app.apply.tooltip_aria') }}"
                                    ><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--color-foreground-subheading);"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg></button>
                                </label>
                                <input
                                    type="file"
                                    class="form-control radius18 @error('autres_activites') is-invalid @enderror"
                                    id="autres_activites" name="autres_activites"
                                    accept=".pdf,application/pdf"
                                >
                                @error('autres_activites')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="button button--primary w-100 justify-content-center">
                                {{ __('app.apply.submit') }}
                                <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                                </svg>
                            </button>

                        </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.apply-info-btn').forEach(function (el) {
        new bootstrap.Popover(el, { html: true, sanitize: false });
    });
});
</script>
@endpush
