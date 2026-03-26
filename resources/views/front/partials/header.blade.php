{{-- Sticky Header --}}
<sticky-header data-sticky-type="always">
    <header class="header-1 header-floating">
        <div class="container-fluid">
            <div class="header-grid">
                <a class="header-logo d-flex align-items-center gap-2" href="{{ route('front.home') }}" aria-label="{{ $settings->company_name ?? 'EYWEP' }}">
                    @if ($settings->company_logo_path)
                        <img
                            src="{{ Storage::url($settings->company_logo_path) }}"
                            alt="{{ $settings->company_name }}"
                            class="eywep-dynamic-logo"
                        >
                    @else
                        <img
                            src="{{ asset('front-assets/consulo/img/logo-white.png') }}"
                            alt="{{ $settings->company_name ?? 'EYWEP' }}"
                            width="189"
                            height="32"
                        >
                    @endif
                    <span class="eywep-brand-name">{{ $settings->company_name ?? 'EYWEP' }}</span>
                </a>

                <drawer-menu>
                    <nav class="header-nav drawer-menu">
                        <div class="d-lg-none header-nav-headings">
                            <a class="header-logo" href="{{ route('front.home') }}" aria-label="{{ $settings->company_name ?? 'EYWEP' }}">
                                @if ($settings->company_logo_path)
                                    <img
                                        src="{{ Storage::url($settings->company_logo_path) }}"
                                        alt="{{ $settings->company_name }}"
                                        class="eywep-dynamic-logo"
                                        loading="lazy"
                                    >
                                @else
                                    <img
                                        src="{{ asset('front-assets/consulo/img/logo.png') }}"
                                        alt="{{ $settings->company_name ?? 'EYWEP' }}"
                                        width="189"
                                        height="32"
                                        loading="lazy"
                                    >
                                @endif
                            </a>
                            <drawer-opener
                                class="svg-wrapper menu-close"
                                data-drawer=".drawer-menu"
                            >
                                <svg
                                    width="30px"
                                    height="30px"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M8.00386 9.41816C7.61333 9.02763 7.61334 8.39447 8.00386 8.00395C8.39438 7.61342 9.02755 7.61342 9.41807 8.00395L12.0057 10.5916L14.5907 8.00657C14.9813 7.61605 15.6144 7.61605 16.0049 8.00657C16.3955 8.3971 16.3955 9.03026 16.0049 9.42079L13.4199 12.0058L16.0039 14.5897C16.3944 14.9803 16.3944 15.6134 16.0039 16.0039C15.6133 16.3945 14.9802 16.3945 14.5896 16.0039L12.0057 13.42L9.42097 16.0048C9.03045 16.3953 8.39728 16.3953 8.00676 16.0048C7.61624 15.6142 7.61624 14.9811 8.00676 14.5905L10.5915 12.0058L8.00386 9.41816Z"
                                        fill="currentColor"
                                    />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12ZM3.00683 12C3.00683 16.9668 7.03321 20.9932 12 20.9932C16.9668 20.9932 20.9932 16.9668 20.9932 12C20.9932 7.03321 16.9668 3.00683 12 3.00683C7.03321 3.00683 3.00683 7.03321 3.00683 12Z"
                                        fill="currentColor"
                                    />
                                </svg>
                            </drawer-opener>
                        </div>

                        <ul class="header-menu list-unstyled">
                            <li class="nav-item">
                                <a href="{{ route('front.home') }}" class="menu-link menu-link-main">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="menu-link menu-link-main menu-accrodion" href="#">
                                    Publications
                                    <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 5L0 0H10L5 5Z" fill="currentColor"/>
                                    </svg>
                                </a>
                                <div class="menu-absolute header-submenu submenu-color">
                                    <ul class="list-unstyled">
                                        <li class="nav-item"><a class="menu-link" href="{{ route('front.articles.index') }}">Articles</a></li>
                                        <li class="nav-item"><a class="menu-link" href="{{ route('front.activities.index') }}">Activités</a></li>
                                        <li class="nav-item"><a class="menu-link" href="{{ route('front.success-stories.index') }}">Témoignages</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('front.galleries.index') }}" class="menu-link menu-link-main">Galeries</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('front.resources.index') }}" class="menu-link menu-link-main">Ressources</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('front.projects.index') }}" class="menu-link menu-link-main">Projets</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('front.about') }}" class="menu-link menu-link-main">À propos</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('front.contact') }}" class="menu-link menu-link-main">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </drawer-menu>

                <div class="header-actions d-flex align-items-center">
                    <a href="{{ route('login') }}" class="button button--secondary" aria-label="Connexion">
                        Connexion
                        <span class="svg-wrapper">
                            <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                            </svg>
                        </span>
                    </a>
                    <drawer-opener
                        class="header-sidebar svg-wrapper d-lg-none ms-3"
                        data-drawer=".drawer-menu"
                    >
                        <svg
                            width="30px"
                            height="30px"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </drawer-opener>
                </div>
            </div>
        </div>
    </header>
</sticky-header>
