@php
    $isDashboardActive = request()->routeIs('admin.dashboard');
    $isArticlesSectionActive = request()->routeIs('articles.*');
    $isArticlesCreateActive = request()->routeIs('articles.create');
    $isArticlesIndexActive = request()->routeIs('articles.index', 'articles.show', 'articles.edit', 'articles.update');
    $isActivitiesSectionActive = request()->routeIs('activities.*');
    $isActivitiesCreateActive = request()->routeIs('activities.create');
    $isActivitiesIndexActive = request()->routeIs('activities.index', 'activities.show', 'activities.edit', 'activities.update');
    $isGalleriesSectionActive = request()->routeIs('galleries.*');
    $isGalleriesCreateActive = request()->routeIs('galleries.create');
    $isGalleriesIndexActive = request()->routeIs('galleries.index', 'galleries.show', 'galleries.edit', 'galleries.update');
    $isNewsSectionActive = request()->routeIs('news.*');
    $isNewsCreateActive = request()->routeIs('news.create');
    $isNewsIndexActive = request()->routeIs('news.index', 'news.show', 'news.edit', 'news.update');
    $isResourcesSectionActive = request()->routeIs('admin.resources.*');
    $isResourcesCreateActive = request()->routeIs('admin.resources.create');
    $isResourcesIndexActive = request()->routeIs('admin.resources.index', 'admin.resources.show', 'admin.resources.edit', 'admin.resources.update');
    $isSuccessStoriesSectionActive = request()->routeIs('success-stories.*');
    $isSuccessStoriesCreateActive = request()->routeIs('success-stories.create');
    $isSuccessStoriesIndexActive = request()->routeIs('success-stories.index', 'success-stories.show', 'success-stories.edit', 'success-stories.update');
    $isPartnersSectionActive = request()->routeIs('admin.partners.*');
    $isPartnersCreateActive = request()->routeIs('admin.partners.create');
    $isPartnersIndexActive = request()->routeIs('admin.partners.index', 'admin.partners.show', 'admin.partners.edit', 'admin.partners.update');
    $isProjectsSectionActive = request()->routeIs('admin.projects.*');
    $isProjectsCreateActive = request()->routeIs('admin.projects.create');
    $isProjectsIndexActive = request()->routeIs('admin.projects.index', 'admin.projects.show', 'admin.projects.edit', 'admin.projects.update');
    $isCandidaturesSectionActive = request()->routeIs('admin.candidatures.*');
    $isCandidaturesIndexActive = request()->routeIs('admin.candidatures.index', 'admin.candidatures.show');
    $isSettingsSectionActive = request()->routeIs('admin.settings.*');
    $isFrontOfficeSettingsActive = request()->routeIs('admin.settings.front-office');
@endphp

<aside class="app-sidebar bg-body-secondary shadow">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            @if ($adminSettings && $adminSettings->company_logo_path)
                <img
                    src="{{ asset('storage/' . $adminSettings->company_logo_path) }}"
                    alt="{{ $adminSettings->company_name ?? 'Logo' }}"
                    class="brand-image opacity-75 shadow"
                />
            @else
                <img
                    src="{{ asset('admin/dist/assets/img/AdminLTELogo.png') }}"
                    alt="Logo"
                    class="brand-image opacity-75 shadow"
                />
            @endif
            <span class="brand-text fw-light">{{ $adminSettings->company_name ?? 'EYWEP-CDJS' }}</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false"
                id="navigation"
            >
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $isDashboardActive ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item {{ $isArticlesSectionActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isArticlesSectionActive ? 'active' : '' }}">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Articles
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('articles.create') }}" class="nav-link {{ $isArticlesCreateActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Creer un article</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('articles.index') }}" class="nav-link {{ $isArticlesIndexActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Liste des articles</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ $isActivitiesSectionActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isActivitiesSectionActive ? 'active' : '' }}">
                        <i class="nav-icon bi bi-calendar-event-fill"></i>
                        <p>
                            Activites
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('activities.create') }}" class="nav-link {{ $isActivitiesCreateActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Creer une activite</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('activities.index') }}" class="nav-link {{ $isActivitiesIndexActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Liste des activites</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ $isGalleriesSectionActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isGalleriesSectionActive ? 'active' : '' }}">
                        <i class="nav-icon bi bi-images"></i>
                        <p>
                            Galeries
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('galleries.create') }}" class="nav-link {{ $isGalleriesCreateActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Creer une galerie</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('galleries.index') }}" class="nav-link {{ $isGalleriesIndexActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Liste des galeries</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ $isNewsSectionActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isNewsSectionActive ? 'active' : '' }}">
                        <i class="nav-icon bi bi-megaphone-fill"></i>
                        <p>
                            Breaking News
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('news.create') }}" class="nav-link {{ $isNewsCreateActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Creer un breaking news</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('news.index') }}" class="nav-link {{ $isNewsIndexActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Liste des breaking news</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ $isResourcesSectionActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isResourcesSectionActive ? 'active' : '' }}">
                        <i class="nav-icon bi bi-folder2-open"></i>
                        <p>
                            Ressources
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.resources.create') }}" class="nav-link {{ $isResourcesCreateActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Ajouter une ressource</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.resources.index') }}" class="nav-link {{ $isResourcesIndexActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Liste des ressources</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ $isSuccessStoriesSectionActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isSuccessStoriesSectionActive ? 'active' : '' }}">
                        <i class="nav-icon bi bi-trophy-fill"></i>
                        <p>
                            Success Stories
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('success-stories.create') }}" class="nav-link {{ $isSuccessStoriesCreateActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Creer une success story</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('success-stories.index') }}" class="nav-link {{ $isSuccessStoriesIndexActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Liste des success stories</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ $isPartnersSectionActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isPartnersSectionActive ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>
                            Partenaires
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.partners.create') }}" class="nav-link {{ $isPartnersCreateActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Ajouter un partenaire</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.partners.index') }}" class="nav-link {{ $isPartnersIndexActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Liste des partenaires</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ $isProjectsSectionActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isProjectsSectionActive ? 'active' : '' }}">
                        <i class="nav-icon bi bi-briefcase-fill"></i>
                        <p>
                            Projets
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.projects.create') }}" class="nav-link {{ $isProjectsCreateActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Creer un projet</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.projects.index') }}" class="nav-link {{ $isProjectsIndexActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Liste des projets</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.candidatures.index') }}" class="nav-link {{ $isCandidaturesSectionActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Candidatures</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ $isSettingsSectionActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isSettingsSectionActive ? 'active' : '' }}">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>
                            Parametrage
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.settings.front-office') }}" class="nav-link {{ $isFrontOfficeSettingsActive ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Front office</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
