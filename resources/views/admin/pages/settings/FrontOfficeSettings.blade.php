@extends('admin.layouts.admin')

@push('styles')
    <style>
        .settings-header {
            background: #fff;
            padding: 1.2rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .settings-title h3 {
            font-family: inherit; /* même police que le tableau */
            font-weight: 600; /* proche des th des tables */
            font-size: 1.25rem; /* taille harmonisée */
            color: #212529;
        }

        .settings-subtitle {
            font-family: inherit;
        }

        .settings-card {
            border: 0;
            border-radius: 1.25rem;
            box-shadow: 0 1rem 2rem rgba(15, 23, 42, 0.08);
        }

        .settings-card .card-header {
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
            background: linear-gradient(180deg, rgba(13, 110, 253, 0.06), rgba(13, 202, 240, 0.03));
            border-radius: 1.25rem 1.25rem 0 0;
        }

        .settings-preview {
            border: 1px dashed rgba(13, 110, 253, 0.25);
            border-radius: 1rem;
            padding: 1rem;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.05), rgba(255, 255, 255, 0.9));
        }

        .settings-color {
            width: 100%;
            height: 46px;
            border: 0;
            border-radius: 0.75rem;
            overflow: hidden;
        }

        .settings-upload-hint {
            border: 1px dashed rgba(13, 110, 253, 0.3);
            border-radius: 1rem;
            padding: 1rem;
            background: rgba(13, 110, 253, 0.04);
        }

        .preview-logo {
            width: 64px;
            height: 64px;
            object-fit: contain;
            border-radius: 0.75rem;
            background: #fff;
            padding: 0.5rem;
            border: 1px solid rgba(15, 23, 42, 0.08);
        }

        .hero-carousel-preview {
            display: flex;
            gap: 0.5rem;
            overflow: auto;
            padding-bottom: 0.25rem;
        }

        .hero-carousel-item {
            width: 92px;
            height: 64px;
            border-radius: 0.75rem;
            object-fit: cover;
            background: #e9ecef;
            flex: 0 0 auto;
            border: 1px solid rgba(15, 23, 42, 0.08);
        }

        .hero-carousel-empty {
            width: 92px;
            height: 64px;
            border-radius: 0.75rem;
            background: #e9ecef;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            flex: 0 0 auto;
        }

        .current-media-card {
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 1rem;
            padding: 1rem;
            background: #fff;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.06);
            transition: box-shadow 0.2s ease;
        }

        .current-media-card:hover {
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.12);
        }

        .current-media-card img,
        .current-media-card video {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 0.75rem;
            background: #e9ecef;
            border: 1px solid rgba(15, 23, 42, 0.08);
        }

        .current-media-card .media-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }

        .current-media-card .media-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: #495057;
            margin: 0;
        }

        .current-media-card .media-actions {
            display: flex;
            gap: 0.5rem;
        }

        .hero-carousel-preview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 1rem;
            max-height: 300px;
            overflow-y: auto;
            padding: 0.5rem;
            border-radius: 0.75rem;
            background: rgba(248, 249, 250, 0.5);
            scrollbar-width: thin;
            scrollbar-color: rgba(15, 23, 42, 0.2) transparent;
        }

        .hero-carousel-preview::-webkit-scrollbar {
            width: 6px;
        }

        .hero-carousel-preview::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.05);
            border-radius: 3px;
        }

        .hero-carousel-preview::-webkit-scrollbar-thumb {
            background: rgba(15, 23, 42, 0.2);
            border-radius: 3px;
        }

        .hero-carousel-preview::-webkit-scrollbar-thumb:hover {
            background: rgba(15, 23, 42, 0.3);
        }

        .hero-carousel-item {
            width: 100%;
            height: 100px;
            border-radius: 0.75rem;
            object-fit: cover;
            background: #e9ecef;
            border: 2px solid rgba(15, 23, 42, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .hero-carousel-item:hover {
            transform: translateY(-2px);
            border-color: rgba(13, 110, 253, 0.4);
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.15);
        }

        .hero-carousel-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.1) 100%);
            border-radius: 0.75rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .hero-carousel-item:hover::after {
            opacity: 1;
        }

        .hero-carousel-empty {
            width: 120px;
            height: 80px;
            border-radius: 0.75rem;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            flex: 0 0 auto;
            border: 2px dashed rgba(15, 23, 42, 0.15);
        }

        .media-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: 1fr;
        }

        @media (min-width: 768px) {
            .media-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .media-preview-container {
            position: relative;
            border-radius: 0.75rem;
            overflow: hidden;
            background: #f8f9fa;
        }

        .media-preview-container video {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .media-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .media-preview-container:hover .media-overlay {
            opacity: 1;
        }

        .media-play-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0d6efd;
            font-size: 1.25rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .settings-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: 1fr;
            font-family: inherit;
        }

        .settings-main {
            display: grid;
            gap: 1rem;
        }

        .settings-sidebar {
            display: grid;
            gap: 1rem;
        }

        .settings-card .card-header h3,
        .settings-card .card-body label,
        .settings-card .card-body input,
        .settings-card .card-body textarea,
        .settings-card .card-body select {
            font-family: inherit;
        }

        @media (min-width: 992px) {
            .settings-grid {
                grid-template-columns: 2fr 1fr;
            }
        }

        @media (min-width: 1400px) {
            .settings-grid {
                grid-template-columns: 2fr 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="settings-header d-flex justify-content-between align-items-center flex-wrap">

            <!-- LEFT -->
            <div class="settings-title">
                <h3 class="mb-0">Parametrage du front office</h3>
                <span class="settings-subtitle">Configuration du site public</span>
            </div>

            <!-- RIGHT -->
            <div>
                <!-- No button for settings -->
            </div>

        </div>

        <!-- Breadcrumb -->
        <div class="row mt-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Parametrage</li>
                </ol>
            </div>
        </div>

    </div>
</div>

    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('admin.settings.front-office.update') }}" method="POST" enctype="multipart/form-data" id="front-office-settings-form">
                @csrf

                <div class="card settings-card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="card-title mb-1">Parametres du site public</h3>
                            <p class="text-muted mb-0">Cette page pilote maintenant les contenus du hero et l'identite visuelle du front office.</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @php
                    $logoUrl = $settings->company_logo_path ? asset('storage/' . $settings->company_logo_path) : null;
                    $heroImages = collect($settings->hero_images ?? [])->map(fn ($path) => asset('storage/' . $path))->all();
                    $heroVideoFileUrl = $settings->hero_video_file_path ? asset('storage/' . $settings->hero_video_file_path) : null;
                @endphp

                <div class="settings-grid">
                    <div class="settings-main">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h3 class="card-title mb-0">Identite visuelle</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="company_name" class="form-label">Nom de l'entreprise</label>
                                <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name', $settings->company_name) }}">
                            </div>
                            <div class="mb-3">
                                <label for="company_slogan" class="form-label">Slogan</label>
                                <input type="text" name="company_slogan" id="company_slogan" class="form-control" value="{{ old('company_slogan', $settings->company_slogan) }}">
                            </div>
                            <div class="mb-3">
                                <label for="company_logo" class="form-label">Logo principal</label>
                                <input type="file" name="company_logo" id="company_logo" class="form-control" accept=".jpg,.jpeg,.png,.webp,.svg">
                                @if ($logoUrl)
                                    <div class="current-media-card mt-3">
                                        <div class="small text-muted mb-2">Logo actuel</div>
                                        <img src="{{ $logoUrl }}" alt="Logo actuel" style="max-width: 180px; max-height: 120px; object-fit: contain;">
                                    </div>
                                @endif
                            </div>
                            <div>
                                <label for="primary_color" class="form-label">Couleur predominante</label>
                                <input type="color" name="primary_color" id="primary_color" class="settings-color" value="{{ old('primary_color', $settings->primary_color ?: '#0d6efd') }}">
                            </div>
                        </div>
                    </div>

                    <div class="card settings-card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Hero et media</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="hero_images" class="form-label">Images d'accueil pour le carousel</label>
                                <input type="file" name="hero_images[]" id="hero_images" class="form-control" accept=".jpg,.jpeg,.png,.webp" multiple>
                                <div class="settings-upload-hint mt-2">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Si tu ajoutes de nouvelles images, elles remplaceront le carousel actuel.
                                </div>
                            </div>

                            @if (!empty($heroImages))
                                <div class="current-media-card mb-3">
                                    <div class="media-header">
                                        <h6 class="media-title">Images actuelles du carousel</h6>
                                        <div class="media-actions">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="checkbox" value="1" id="remove_hero_images" name="remove_hero_images">
                                                <label class="form-check-label text-danger small" for="remove_hero_images">
                                                    Supprimer
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hero-carousel-preview">
                                        @foreach ($heroImages as $imageUrl)
                                            <img src="{{ $imageUrl }}" alt="Image carousel" class="hero-carousel-item" onclick="window.open(this.src, '_blank')">
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="hero_video_file" class="form-label">Video principale en fichier</label>
                                <input type="file" name="hero_video_file" id="hero_video_file" class="form-control" accept=".mp4,.mov,.avi,.webm">
                                <small class="text-muted d-block mt-2">Optionnel : tu peux televerser une video locale.</small>
                                @if ($heroVideoFileUrl)
                                    <div class="current-media-card mb-3">
                                        <div class="media-header">
                                            <h6 class="media-title">Video locale actuelle</h6>
                                            <div class="media-actions">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" value="1" id="remove_hero_video_file" name="remove_hero_video_file">
                                                    <label class="form-check-label text-danger small" for="remove_hero_video_file">
                                                        Supprimer
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media-preview-container">
                                            <video controls muted playsinline>
                                                <source src="{{ $heroVideoFileUrl }}">
                                            </video>
                                            <div class="media-overlay">
                                                <div class="media-play-icon">
                                                    <i class="bi bi-play-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="hero_video" class="form-label">Lien de video principale</label>
                                <input type="url" name="hero_video" id="hero_video" class="form-control" value="{{ old('hero_video', $settings->hero_video_url) }}" placeholder="https://youtube.com/...">
                                <small class="text-muted d-block mt-2">Optionnel : tu peux aussi utiliser un lien externe a la place d'un fichier.</small>
                            </div>
                            <div class="mb-3">
                                <label for="hero_title" class="form-label">Titre de mise en avant</label>
                                <input type="text" name="hero_title" id="hero_title" class="form-control" value="{{ old('hero_title', $settings->hero_title) }}">
                            </div>
                            <div>
                                <label for="hero_subtitle" class="form-label">Texte de mise en avant</label>
                                <textarea name="hero_subtitle" id="hero_subtitle" rows="4" class="form-control">{{ old('hero_subtitle', $settings->hero_subtitle) }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="settings-sidebar">
                    <div class="card settings-card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Coordonnees et localisation</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="company_address" class="form-label">Adresse</label>
                                    <input type="text" name="company_address" id="company_address" class="form-control" value="{{ old('company_address', $settings->company_address) }}">
                                </div>

                                <div class="col-md-12">
                                    <label for="company_location" class="form-label">URL d'intégration Google Maps</label>
                                    <input type="url" name="company_location" id="company_location" class="form-control" value="{{ old('company_location', $settings->company_location) }}" placeholder="https://www.google.com/maps/embed?pb=...">
                                    <small class="text-muted d-block mt-1">Coller l'URL d'intégration Maps (iframe src). Par défaut : Abuja, Nigeria.</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="company_phone" class="form-label">Telephone</label>
                                    <input type="text" name="company_phone" id="company_phone" class="form-control" value="{{ old('company_phone', $settings->company_phone) }}" placeholder="+226 ...">
                                </div>

                                <div class="col-md-6">
                                    <label for="company_email" class="form-label">Email</label>
                                    <input type="email" name="company_email" id="company_email" class="form-control" value="{{ old('company_email', $settings->company_email) }}" placeholder="contact@entreprise.com">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card settings-card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Réseaux sociaux</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="social_facebook" class="form-label">Facebook</label>
                                    <input type="url" name="social_facebook" id="social_facebook" class="form-control" value="{{ old('social_facebook', $settings->social_facebook) }}" placeholder="https://www.facebook.com/...">
                                </div>
                                <div class="col-md-12">
                                    <label for="social_linkedin" class="form-label">LinkedIn</label>
                                    <input type="url" name="social_linkedin" id="social_linkedin" class="form-control" value="{{ old('social_linkedin', $settings->social_linkedin) }}" placeholder="https://www.linkedin.com/...">
                                </div>
                                <div class="col-md-12">
                                    <label for="social_twitter" class="form-label">Twitter / X</label>
                                    <input type="url" name="social_twitter" id="social_twitter" class="form-control" value="{{ old('social_twitter', $settings->social_twitter) }}" placeholder="https://x.com/...">
                                </div>
                                <div class="col-md-12">
                                    <label for="social_whatsapp" class="form-label">WhatsApp</label>
                                    <input type="url" name="social_whatsapp" id="social_whatsapp" class="form-control" value="{{ old('social_whatsapp', $settings->social_whatsapp) }}" placeholder="https://wa.me/NUMERO">
                                    <small class="text-muted d-block mt-1">Format : https://wa.me/22600000000 (sans le +)</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card settings-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Liens utiles du footer</h3>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="add-footer-link">
                                <i class="bi bi-plus-lg me-1"></i>Ajouter
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="footer-links-list">
                                @forelse ($settings->footer_links ?? [] as $i => $link)
                                    <div class="footer-link-row d-flex gap-2 mb-2 align-items-center">
                                        <input type="text" name="footer_links[{{ $i }}][label]" class="form-control form-control-sm" placeholder="Libellé" value="{{ $link['label'] ?? '' }}">
                                        <input type="text" name="footer_links[{{ $i }}][url]" class="form-control form-control-sm" placeholder="URL ou /chemin" value="{{ $link['url'] ?? '' }}">
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-footer-link flex-shrink-0" title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                @empty
                                    <p class="text-muted small mb-2">Aucun lien configuré.</p>
                                @endforelse
                            </div>
                            <small class="text-muted">Ces liens apparaîtront dans le footer sous "Liens utiles".</small>
                        </div>
                    </div>

                    <div class="card settings-card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Apercu de la marque</h3>
                        </div>
                        <div class="card-body">
                            <div class="settings-preview">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div id="preview-logo-shell" class="rounded-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px; background: var(--preview-color, #0d6efd); color: #fff;">
                                        <img id="preview-logo-image" src="{{ $logoUrl }}" alt="Logo" class="preview-logo {{ $logoUrl ? '' : 'd-none' }}">
                                        <i id="preview-logo-icon" class="bi bi-image fs-3 {{ $logoUrl ? 'd-none' : '' }}"></i>
                                    </div>
                                    <div>
                                        <h4 id="preview-company-name" class="mb-1">{{ $settings->company_name ?: 'Nom de l entreprise' }}</h4>
                                        <p id="preview-company-slogan" class="text-muted mb-0">{{ $settings->company_slogan ?: 'Slogan de votre structure' }}</p>
                                    </div>
                                </div>
                                <div class="ratio ratio-16x9 rounded-4 overflow-hidden bg-dark-subtle mb-3">
                                    <div id="preview-video-placeholder" class="d-flex align-items-center justify-content-center text-muted">
                                        Video principale du front office
                                    </div>
                                    <video id="preview-video-file" class="w-100 h-100 object-fit-cover d-none" controls muted playsinline></video>
                                    <div id="preview-video-url" class="d-none w-100 h-100 d-flex align-items-center justify-content-center flex-column text-center p-3">
                                        <i class="bi bi-play-btn fs-1 text-primary mb-2"></i>
                                        <div class="small text-muted">Lien video externe configure</div>
                                    </div>
                                </div>
                                <div class="rounded-4 overflow-hidden bg-light border p-3 mb-3">
                                    <div class="small text-uppercase text-muted fw-semibold mb-2">Carousel d'accueil</div>
                                    <div id="preview-carousel" class="hero-carousel-preview">
                                        @if (!empty($heroImages))
                                            @foreach ($heroImages as $imageUrl)
                                                <img src="{{ $imageUrl }}" alt="Image carousel" class="hero-carousel-item">
                                            @endforeach
                                        @else
                                            <div class="hero-carousel-empty"><i class="bi bi-image"></i></div>
                                            <div class="hero-carousel-empty"><i class="bi bi-image"></i></div>
                                            <div class="hero-carousel-empty"><i class="bi bi-image"></i></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <h5 id="preview-hero-title" class="mb-2">{{ $settings->hero_title ?: 'Titre de mise en avant' }}</h5>
                                    <p id="preview-hero-subtitle" class="text-muted mb-0">{{ $settings->hero_subtitle ?: 'Texte de mise en avant du front office.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const companyName = document.getElementById('company_name');
            const companySlogan = document.getElementById('company_slogan');
            const companyLogo = document.getElementById('company_logo');
            const primaryColor = document.getElementById('primary_color');
            const heroImages = document.getElementById('hero_images');
            const heroVideoFile = document.getElementById('hero_video_file');
            const heroVideoUrl = document.getElementById('hero_video');
            const heroTitle = document.getElementById('hero_title');
            const heroSubtitle = document.getElementById('hero_subtitle');
            const removeHeroImages = document.getElementById('remove_hero_images');
            const removeHeroVideoFile = document.getElementById('remove_hero_video_file');

            const previewCompanyName = document.getElementById('preview-company-name');
            const previewCompanySlogan = document.getElementById('preview-company-slogan');
            const previewLogoImage = document.getElementById('preview-logo-image');
            const previewLogoIcon = document.getElementById('preview-logo-icon');
            const previewLogoShell = document.getElementById('preview-logo-shell');
            const previewHeroTitle = document.getElementById('preview-hero-title');
            const previewHeroSubtitle = document.getElementById('preview-hero-subtitle');
            const previewCarousel = document.getElementById('preview-carousel');
            const previewVideoFile = document.getElementById('preview-video-file');
            const previewVideoUrl = document.getElementById('preview-video-url');
            const previewVideoPlaceholder = document.getElementById('preview-video-placeholder');

            const defaultLogo = previewLogoImage.getAttribute('src');
            const defaultCarouselItems = previewCarousel.innerHTML;
            const defaultVideoFile = previewVideoFile.querySelector('source');

            const updateTextPreview = function () {
                previewCompanyName.textContent = companyName.value || 'Nom de l entreprise';
                previewCompanySlogan.textContent = companySlogan.value || 'Slogan de votre structure';
                previewHeroTitle.textContent = heroTitle.value || 'Titre de mise en avant';
                previewHeroSubtitle.textContent = heroSubtitle.value || 'Texte de mise en avant du front office.';
                previewLogoShell.style.setProperty('--preview-color', primaryColor.value || '#0d6efd');
            };

            const updateLogoPreview = function () {
                const file = companyLogo.files[0];

                if (file) {
                    previewLogoImage.src = URL.createObjectURL(file);
                    previewLogoImage.classList.remove('d-none');
                    previewLogoIcon.classList.add('d-none');
                    return;
                }

                if (defaultLogo) {
                    previewLogoImage.src = defaultLogo;
                    previewLogoImage.classList.remove('d-none');
                    previewLogoIcon.classList.add('d-none');
                    return;
                }

                previewLogoImage.classList.add('d-none');
                previewLogoIcon.classList.remove('d-none');
            };

            const updateCarouselPreview = function () {
                if (removeHeroImages && removeHeroImages.checked) {
                    previewCarousel.innerHTML = `
                        <div class="hero-carousel-empty"><i class="bi bi-image"></i></div>
                        <div class="hero-carousel-empty"><i class="bi bi-image"></i></div>
                        <div class="hero-carousel-empty"><i class="bi bi-image"></i></div>
                    `;
                    return;
                }

                if (heroImages.files.length) {
                    previewCarousel.innerHTML = '';

                    Array.from(heroImages.files).forEach(function (file) {
                        const image = document.createElement('img');
                        image.src = URL.createObjectURL(file);
                        image.alt = file.name;
                        image.className = 'hero-carousel-item';
                        previewCarousel.appendChild(image);
                    });

                    return;
                }

                previewCarousel.innerHTML = defaultCarouselItems;
            };

            const updateVideoPreview = function () {
                const file = heroVideoFile.files[0];
                const url = heroVideoUrl.value.trim();
                const hideAll = function () {
                    previewVideoFile.classList.add('d-none');
                    previewVideoUrl.classList.add('d-none');
                    previewVideoPlaceholder.classList.remove('d-none');
                };

                if (removeHeroVideoFile && removeHeroVideoFile.checked && !url) {
                    hideAll();
                    return;
                }

                if (file) {
                    previewVideoFile.src = URL.createObjectURL(file);
                    previewVideoFile.classList.remove('d-none');
                    previewVideoUrl.classList.add('d-none');
                    previewVideoPlaceholder.classList.add('d-none');
                    return;
                }

                if (url) {
                    previewVideoFile.classList.add('d-none');
                    previewVideoUrl.classList.remove('d-none');
                    previewVideoPlaceholder.classList.add('d-none');
                    return;
                }

                @if ($heroVideoFileUrl)
                    if (!(removeHeroVideoFile && removeHeroVideoFile.checked)) {
                        previewVideoFile.src = @json($heroVideoFileUrl);
                        previewVideoFile.classList.remove('d-none');
                        previewVideoUrl.classList.add('d-none');
                        previewVideoPlaceholder.classList.add('d-none');
                        return;
                    }
                @endif

                @if ($settings->hero_video_url)
                    previewVideoFile.classList.add('d-none');
                    previewVideoUrl.classList.remove('d-none');
                    previewVideoPlaceholder.classList.add('d-none');
                    return;
                @endif

                hideAll();
            };

            [companyName, companySlogan, primaryColor, heroTitle, heroSubtitle].forEach(function (element) {
                element.addEventListener('input', updateTextPreview);
            });

            companyLogo.addEventListener('change', updateLogoPreview);
            heroImages.addEventListener('change', updateCarouselPreview);
            heroVideoFile.addEventListener('change', updateVideoPreview);
            heroVideoUrl.addEventListener('input', updateVideoPreview);

            if (removeHeroImages) {
                removeHeroImages.addEventListener('change', updateCarouselPreview);
            }

            if (removeHeroVideoFile) {
                removeHeroVideoFile.addEventListener('change', updateVideoPreview);
            }

            updateTextPreview();
            updateLogoPreview();
            updateCarouselPreview();
            updateVideoPreview();

            // Liens utiles du footer
            const footerLinksList = document.getElementById('footer-links-list');
            const addFooterLinkBtn = document.getElementById('add-footer-link');

            function getNextIndex() {
                return footerLinksList.querySelectorAll('.footer-link-row').length;
            }

            function removePlaceholder() {
                const placeholder = footerLinksList.querySelector('p.text-muted');
                if (placeholder) placeholder.remove();
            }

            addFooterLinkBtn.addEventListener('click', function () {
                removePlaceholder();
                const idx = getNextIndex();
                const row = document.createElement('div');
                row.className = 'footer-link-row d-flex gap-2 mb-2 align-items-center';
                row.innerHTML = `
                    <input type="text" name="footer_links[${idx}][label]" class="form-control form-control-sm" placeholder="Libellé">
                    <input type="text" name="footer_links[${idx}][url]" class="form-control form-control-sm" placeholder="URL ou /chemin">
                    <button type="button" class="btn btn-sm btn-outline-danger remove-footer-link flex-shrink-0" title="Supprimer">
                        <i class="bi bi-trash"></i>
                    </button>`;
                footerLinksList.appendChild(row);
            });

            footerLinksList.addEventListener('click', function (e) {
                const btn = e.target.closest('.remove-footer-link');
                if (!btn) return;
                btn.closest('.footer-link-row').remove();
                // Re-indexer les champs pour garder des indices continus
                footerLinksList.querySelectorAll('.footer-link-row').forEach(function (row, i) {
                    row.querySelectorAll('input').forEach(function (input) {
                        input.name = input.name.replace(/footer_links\[\d+\]/, `footer_links[${i}]`);
                    });
                });
                if (!footerLinksList.querySelector('.footer-link-row')) {
                    footerLinksList.innerHTML = '<p class="text-muted small mb-2">Aucun lien configuré.</p>';
                }
            });
        });
    </script>
@endpush
