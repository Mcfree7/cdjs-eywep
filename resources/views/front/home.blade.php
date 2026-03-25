@php
    $primaryArticle = $articles->get(0);
    $secondaryArticle = $articles->get(1);
    $tertiaryArticle = $articles->get(2);
    $primaryActivity = $activities->get(0);
    $secondaryActivity = $activities->get(1);
    $tertiaryActivity = $activities->get(2);
    $primaryStory = $successStories->get(0);
    $secondaryStory = $successStories->get(1);
    $tertiaryStory = $successStories->get(2);
    $primaryGallery = $galleries->get(0);
    $secondaryGallery = $galleries->get(1);
    $tertiaryGallery = $galleries->get(2);
    $quaternaryGallery = $galleries->get(3);
    $heroImages = collect($settings->hero_images ?? []);
    $heroOne = $heroImages->get(0);
    $heroTwo = $heroImages->get(1);
    $heroThree = $heroImages->get(2);
@endphp
<!DOCTYPE html>
<html lang="en" class="no-js">
  
<head>
    <title>{{ $settings->company_name ?? 'EYWEP' }} - Accueil</title>
    <link
      rel="shortcut icon"
      href="{{ asset('front-assets/consulo') }}/img/favicon.png"
      type="image/x-icon"
    />

    <!-- meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="view-transition" content="same-origin" />
    <meta name="theme-color" content="Red" />
    <meta property="og:site_name" content="Consulo" />
    <meta
      property="og:url"
      content="https://themeforest.net/user/spreethemes/portfolio"
    />
    <meta property="og:title" content="Creative Business Consulting Template" />
    <meta
      property="og:description"
      content="A versatile HTML template designed for corporate entities and professional businesses."
    />
    <meta
      name="description"
      content="{{ $settings->company_slogan ?? 'Programme EYWEP' }}"
    />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&amp;family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      rel="stylesheet"
    />

    <!-- all css -->
    <link rel="stylesheet" href="{{ asset('front-assets/consulo') }}/css/vendor.css" />
    <style>
      :root {
        /* Typography */
        --font-body--family: "Inter", sans-serif;
        --font-body--style: normal;
        --font-body--weight: 400;

        --font-heading--family: "Poppins", sans-serif;
        --font-heading--style: normal;
        --font-heading--weight: 600;

        --font-button--family: "Poppins", sans-serif;
        --font-button--style: normal;
        --font-button--weight: 600;

        /* h1-h6 */
        --font-h1--size: 60px;
        --font-h2--size: 48px;
        --font-h3--size: 36px;
        --font-h4--size: 24px;
        --font-h5--size: 20px;
        --font-h6--size: 16px;

        /* header nav */
        --font-nav-main: 16px;

        /* Colors */
        --color-background: rgba(255, 255, 255, 1);
        --color-foreground: rgba(28, 37, 57, 1);
        --color-foreground-heading: rgba(28, 37, 57, 1);
        --color-foreground-subheading: rgba(93, 102, 111, 1);
        --color-background-subheading: rgba(255, 255, 255, 0.1);
        --color-border-subheading-bg: rgba(32, 40, 45, 0.1);
        --color-primary: rgba(28, 37, 57, 1);
        --color-primary-background: rgba(28, 37, 57, 1);
        --color-primary-hover: rgba(28, 37, 57, 1);
        --color-primary-background-hover: rgba(28, 37, 57, 1);
        --color-border: rgba(255, 255, 255, 0.3);
        --color-border-hover: rgba(93, 102, 111, 0.5);
        --color-shadow: rgba(0, 0, 0, 1);
        --color-overlay: rgba(28, 37, 57, 0.6);

        /* Buttons */
        --font-button-size: 16px;
        --font-button-size-mobile: 16px;
        --style-button-height: 56px;
        --style-button-height-mobile: 48px;
        --style-button-slim-height: 52px;
        --style-button-slim-height-mobile: 40px;
        --style-cta-underline-offset: 5px;
        --style-cta-underline-thickness: 1px;

        /* Colors - Primary Button */
        --color-primary-button-text: rgba(255, 255, 255, 1);
        --color-primary-button-background: rgba(32, 40, 45, 1);
        --color-primary-button-border: rgba(32, 40, 45, 1);
        --color-primary-button-icon: rgba(28, 37, 57, 1);
        --color-primary-button-icon-background: rgba(255, 255, 255, 1);

        --color-primary-button-hover-text: rgba(32, 40, 45, 1);
        --color-primary-button-hover-background: rgba(255, 255, 255, 1);
        --color-primary-button-hover-border: rgba(32, 40, 45, 1);
        --color-primary-button-hover-icon: rgba(255, 255, 255, 1);
        --color-primary-button-hover-icon-background: rgba(28, 37, 57, 1);

        /* Colors - Secondary Button */
        --color-secondary-button-text: rgba(32, 40, 45, 1);
        --color-secondary-button-background: rgba(255, 255, 255, 1);
        --color-secondary-button-border: rgba(255, 255, 255, 1);
        --color-secondary-button-icon: rgba(255, 255, 255, 1);
        --color-secondary-button-icon-background: rgba(32, 40, 45, 1);

        --color-secondary-button-hover-text: rgba(255, 255, 255, 1);
        --color-secondary-button-hover-background: rgba(32, 40, 45, 1);
        --color-secondary-button-hover-border: rgba(32, 40, 45, 1);
        --color-secondary-button-hover-icon: rgba(28, 37, 57, 1);
        --color-secondary-button-hover-icon-background: rgba(255, 255, 255, 1);

        /* Colors - Input */
        --color-input-background: rgba(255, 255, 255, 1);
        --color-input-text: rgba(93, 102, 111, 1);
        --color-input-border: rgba(93, 102, 111, 0.2);
        --color-input-hover-background: rgba(255, 255, 255, 1);
        --color-input-hover-text: rgba(93, 102, 111, 1);
        --color-input-hover-border: rgba(93, 102, 111, 0.2);

        /* Borders */
        --style-border-width-buttons-primary: 1px;
        --style-border-width-buttons-secondary: 1px;
        --style-border-radius-buttons-primary: 40px;
        --style-border-radius-buttons-secondary: 40px;

        --style-border-width-inputs: 1px;
        --style-border-radius-inputs: 8px;
        --style-border-width: 1px;

        /* Focus */
        --focus-outline-width: 1px;
        --focus-outline-offset: 3px;

        /* Pagination */
        --style-pagination-border-width: 1px;
        --pagination-item-foreground: rgba(28, 37, 57, 1);
        --pagination-item-background: rgba(242, 242, 242, 1);
        --pagination-item-border: rgba(242, 242, 242, 1);
        --pagination-item-active-foreground: rgba(255, 255, 255, 1);
        --pagination-item-active-background: rgba(28, 37, 57, 1);
        --pagination-item-active-border: rgba(28, 37, 57, 1);

        /* Swiper */
        --swiper-navigation-size: 16px;
        --swiper-navigation-color: rgba(255, 255, 255, 1);
        --swiper-navigation-background-color: transparent;
        --swiper-navigation-hover-color: rgba(255, 255, 255, 1);
        --swiper-navigation-hover-background-color: rgba(255, 255, 255, 0.15);
        --swiper-pagination-bullet-inactive-color: rgba(242, 242, 242);
        --swiper-pagination-color: rgba(28, 37, 57, 1);
        --swiper-pagination-bullet-inactive-opacity: 1;
      }

      @media (max-width: 767px) {
        :root {
          --font-h1--size: 48px;
          --font-h2--size: 40px;
          --font-h3--size: 28px;
          --font-h4--size: 20px;
          --font-h5--size: 18px;
        }
      }
    </style>
    <link rel="stylesheet" href="{{ asset('front-assets/consulo') }}/css/style.css" />
  </head>

  <body>
    <!-- Header 1 -->
    <sticky-header data-sticky-type="always">
      <header class="header-1 header-floating">
        <div class="container-fluid">
          <div class="header-grid">
            <a class="header-logo" href="{{ route('front.home') }}" aria-label="Consulo">
              <img
                src="{{ asset('front-assets/consulo') }}/img/logo-white.png"
                alt="Consulo Logo"
                width="189"
                height="32"
              />
            </a>
            <drawer-menu>
              <nav class="header-nav drawer-menu">
                <div class="d-lg-none header-nav-headings">
                  <a
                    class="header-logo"
                    href="{{ route('front.home') }}"
                    aria-label="Consulo"
                  >
                    <img
                      src="{{ asset('front-assets/consulo') }}/img/logo.png"
                      alt="Consulo Logo"
                      width="189"
                      height="32"
                      loading="lazy"
                    />
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
                    <a
                      class="menu-link menu-link-main menu-accrodion"
                      href="{{ route('front.home') }}"
                    >
                      Home
                      <svg
                        width="10"
                        height="5"
                        viewBox="0 0 10 5"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path d="M5 5L0 0H10L5 5Z" fill="currentColor" />
                      </svg>
                    </a>
                    <div class="menu-absolute header-submenu submenu-color">
                      <ul class="list-unstyled">
                        <li class="nav-item">
                          <a class="menu-link" href="{{ route('front.home') }}">Home 1</a>
                        </li>
                        <li class="nav-item">
                          <a class="menu-link" href="{{ route('front.home') }}">Home 2</a>
                        </li>
                        <li class="nav-item">
                          <a class="menu-link" href="{{ route('front.home') }}">Home 3</a>
                        </li>
                        <li class="nav-item">
                          <a class="menu-link" href="{{ route('front.home') }}">Home 4</a>
                        </li>
                        <li class="nav-item">
                          <a class="menu-link" href="{{ route('front.home') }}">Home 5</a>
                        </li>
                        <li class="nav-item">
                          <a class="menu-link" href="{{ route('front.home') }}">Home 6</a>
                        </li>
                        <li class="nav-item">
                          <a class="menu-link" href="{{ route('front.home') }}">Home 7</a>
                        </li>
                        <li class="nav-item">
                          <a class="menu-link" href="{{ route('front.home') }}">Home 8</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="menu-link menu-link-main" href="{{ route('front.home') }}">
                      About Us
                    </a>
                  </li>
                  <li class="nav-item nav-item-static">
                    <a
                      class="menu-link menu-link-main menu-accrodion"
                      href="{{ route('front.activities.index') }}"
                    >
                      Services
                      <svg
                        width="10"
                        height="5"
                        viewBox="0 0 10 5"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path d="M5 5L0 0H10L5 5Z" fill="currentColor" />
                      </svg>
                    </a>
                    <div
                      class="header-megamenu header-submenu menu-absolute submenu-color"
                    >
                      <ul class="list-unstyled">
                        <li class="nav-item">
                          <a class="menu-link heading fw-300" href="{{ route('front.articles.index') }}">
                            WHY CONSULO
                          </a>
                          <ul class="reset-submenu list-unstyled submenu-color">
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.activities.index') }}">
                                <div class="heading text-20 fw-600">
                                  Become a Partner
                                </div>
                                <div class="text text-14">
                                  Links customers with trusted Partners who help
                                  them realize greater value—faster—through
                                  Consulo.
                                </div>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.galleries.index') }}">
                                <div class="heading text-20 fw-600">
                                  Case Studies
                                </div>
                                <div class="text text-14">
                                  Hundreds of emerging brands thrive with
                                  Consulo. Discover their journeys.
                                </div>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.galleries.index') }}">
                                <div class="heading text-20 fw-600">
                                  Product Development
                                </div>
                                <div class="text text-14">
                                  Speed up innovation to enable quicker,
                                  effective team-driven product launches.
                                </div>
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li class="nav-item">
                          <a
                            class="menu-link heading fw-300"
                            href="{{ route('front.galleries.index') }}"
                          >
                            FEATURED CASE STUDY
                          </a>
                          <ul class="reset-submenu list-unstyled submenu-color">
                            <li class="nav-item">
                              <a
                                class="menu-link megamenu-image-wrap"
                                href="{{ route('front.galleries.index') }}"
                              >
                                <picture>
                                  <source
                                    media="(max-width: 575px)"
                                    srcset="{{ asset('front-assets/consulo') }}/img/menu/575.jpg"
                                  />
                                  <img
                                    src="{{ asset('front-assets/consulo') }}/img/menu/1.jpg"
                                    width="1000"
                                    height="668"
                                    loading="lazy"
                                    alt="Hero Image"
                                  />
                                </picture>
                                <div class="content">
                                  <div class="heading text-20 fw-600">
                                    <div class="heading text-20 fw-600">
                                      Consulo Subscriptions
                                    </div>
                                    <div class="text text-14">
                                      Hundreds of emerging brands thrive with
                                      Consulo. Discover their journeys.
                                    </div>
                                  </div>
                                  <div class="button button--primary">
                                    <span class="svg-wrapper">
                                      <svg
                                        class="icon-20"
                                        width="20"
                                        height="20"
                                        viewBox="0 0 20 20"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                      >
                                        <path
                                          d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z"
                                          fill="currentColor"
                                        ></path>
                                      </svg>
                                    </span>
                                  </div>
                                </div>
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li class="nav-item megamenu-links">
                          <a
                            class="menu-link text-14 fw-300"
                            href="#contact"
                          >
                            <svg
                              class="icon-18"
                              width="20px"
                              height="20px"
                              viewBox="0 0 24 24"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04346 16.4525C3.22094 16.8088 3.28001 17.2161 3.17712 17.6006L2.58151 19.8267C2.32295 20.793 3.20701 21.677 4.17335 21.4185L6.39939 20.8229C6.78393 20.72 7.19121 20.7791 7.54753 20.9565C8.88837 21.6244 10.4003 22 12 22Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                              />
                              <path
                                opacity="0.5"
                                d="M8 10.5H16"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                              />
                              <path
                                opacity="0.5"
                                d="M8 14H13.5"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                              />
                            </svg>
                            Contact Sales
                          </a>
                          <a
                            class="menu-link text-14 fw-300"
                            href="{{ route('front.galleries.index') }}"
                          >
                            <svg
                              class="icon-18"
                              width="20px"
                              height="20px"
                              viewBox="0 0 24 24"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <circle
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="1.5"
                              />
                              <path
                                d="M15.4137 10.941C16.1954 11.4026 16.1954 12.5974 15.4137 13.059L10.6935 15.8458C9.93371 16.2944 9 15.7105 9 14.7868L9 9.21316C9 8.28947 9.93371 7.70561 10.6935 8.15419L15.4137 10.941Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                              />
                            </svg>
                            Watch Demo
                          </a>
                          <a class="menu-link text-14 fw-300" href="{{ route('front.success-stories.index') }}">
                            <svg
                              class="icon-18"
                              width="20px"
                              height="20px"
                              viewBox="0 0 24 24"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <circle
                                cx="9"
                                cy="9"
                                r="2"
                                stroke="currentColor"
                                stroke-width="1.5"
                              />
                              <path
                                d="M13 15C13 16.1046 13 17 9 17C5 17 5 16.1046 5 15C5 13.8954 6.79086 13 9 13C11.2091 13 13 13.8954 13 15Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                              />
                              <path
                                d="M22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C21.298 5.64118 21.5794 6.2255 21.748 7"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                              />
                              <path
                                d="M19 12H15"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                              />
                              <path
                                d="M19 9H14"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                              />
                              <path
                                d="M19 15H16"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                              />
                            </svg>
                            Webinars
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item nav-item-static">
                    <a
                      class="menu-link menu-link-main menu-accrodion"
                      href="{{ route('front.resources.index') }}"
                    >
                      Pages
                      <svg
                        width="10"
                        height="5"
                        viewBox="0 0 10 5"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path d="M5 5L0 0H10L5 5Z" fill="currentColor" />
                      </svg>
                    </a>
                    <div
                      class="header-megamenu header-submenu menu-absolute submenu-color"
                    >
                      <ul class="list-unstyled">
                        <li class="nav-item">
                          <a class="menu-link heading fw-300" href="{{ route('front.articles.index') }}"
                            >SERVICE PAGES</a
                          >
                          <ul
                            class="submenu-lists reset-submenu list-unstyled submenu-color"
                          >
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.activities.index') }}">
                                <div class="heading text-18 fw-500">
                                  Services
                                </div>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.activities.index') }}">
                                <div class="heading text-18 fw-500">
                                  Services Details
                                </div>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.resources.index') }}">
                                <div class="heading text-18 fw-500">
                                  Pricing Plan
                                </div>
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li class="nav-item">
                          <a class="menu-link heading fw-300" href="{{ route('front.articles.index') }}"
                            >BLOG PAGES</a
                          >
                          <ul
                            class="submenu-lists reset-submenu list-unstyled submenu-color"
                          >
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.articles.index') }}">
                                <div class="heading text-18 fw-500">Blog</div>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.articles.index') }}">
                                <div class="heading text-18 fw-500">
                                  Blog List
                                </div>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.articles.index') }}">
                                <div class="heading text-18 fw-500">
                                  Blog Details
                                </div>
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li class="nav-item">
                          <a class="menu-link heading fw-300" href="{{ route('front.articles.index') }}"
                            >OTHER PAGES</a
                          >
                          <ul
                            class="submenu-lists reset-submenu list-unstyled submenu-color"
                          >
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.home') }}">
                                <div class="heading text-18 fw-500">
                                  About Us
                                </div>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="menu-link" href="#contact">
                                <div class="heading text-18 fw-500">
                                  Contact Us
                                </div>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="menu-link" href="#contact">
                                <div class="heading text-18 fw-500">
                                  Contact Us 2
                                </div>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.resources.index') }}">
                                <div class="heading text-18 fw-500">FAQ</div>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="menu-link" href="error.html">
                                <div class="heading text-18 fw-500">
                                  404 Page
                                </div>
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li class="nav-item">
                          <a class="menu-link heading fw-300" href="{{ route('front.articles.index') }}"
                            >PROJECTS</a
                          >
                          <ul
                            class="submenu-lists reset-submenu list-unstyled submenu-color"
                          >
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.galleries.index') }}">
                                <div class="heading text-18 fw-500">
                                  Project
                                </div>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.galleries.index') }}">
                                <div class="heading text-18 fw-500">
                                  Project Details
                                </div>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.success-stories.index') }}">
                                <div class="heading text-18 fw-500">
                                  Our Team
                                </div>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="menu-link" href="{{ route('front.success-stories.index') }}">
                                <div class="heading text-18 fw-500">
                                  Team Details
                                </div>
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li class="nav-item megamenu-links">
                          <a
                            class="menu-link text-14 fw-300"
                            href="#contact"
                          >
                            <svg
                              class="icon-18"
                              width="20px"
                              height="20px"
                              viewBox="0 0 24 24"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04346 16.4525C3.22094 16.8088 3.28001 17.2161 3.17712 17.6006L2.58151 19.8267C2.32295 20.793 3.20701 21.677 4.17335 21.4185L6.39939 20.8229C6.78393 20.72 7.19121 20.7791 7.54753 20.9565C8.88837 21.6244 10.4003 22 12 22Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                              />
                              <path
                                opacity="0.5"
                                d="M8 10.5H16"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                              />
                              <path
                                opacity="0.5"
                                d="M8 14H13.5"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                              />
                            </svg>
                            Contact Sales
                          </a>
                          <a
                            class="menu-link text-14 fw-300"
                            href="{{ route('front.galleries.index') }}"
                          >
                            <svg
                              class="icon-18"
                              width="20px"
                              height="20px"
                              viewBox="0 0 24 24"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <circle
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="1.5"
                              />
                              <path
                                d="M15.4137 10.941C16.1954 11.4026 16.1954 12.5974 15.4137 13.059L10.6935 15.8458C9.93371 16.2944 9 15.7105 9 14.7868L9 9.21316C9 8.28947 9.93371 7.70561 10.6935 8.15419L15.4137 10.941Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                              />
                            </svg>
                            Watch Demo
                          </a>
                          <a class="menu-link text-14 fw-300" href="{{ route('front.success-stories.index') }}">
                            <svg
                              class="icon-18"
                              width="20px"
                              height="20px"
                              viewBox="0 0 24 24"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <circle
                                cx="9"
                                cy="9"
                                r="2"
                                stroke="currentColor"
                                stroke-width="1.5"
                              />
                              <path
                                d="M13 15C13 16.1046 13 17 9 17C5 17 5 16.1046 5 15C5 13.8954 6.79086 13 9 13C11.2091 13 13 13.8954 13 15Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                              />
                              <path
                                d="M22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C21.298 5.64118 21.5794 6.2255 21.748 7"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                              />
                              <path
                                d="M19 12H15"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                              />
                              <path
                                d="M19 9H14"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                              />
                              <path
                                d="M19 15H16"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                              />
                            </svg>
                            Webinars
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a
                      class="menu-link menu-link-main menu-accrodion"
                      href="{{ route('front.articles.index') }}"
                    >
                      Blog
                      <svg
                        width="10"
                        height="5"
                        viewBox="0 0 10 5"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path d="M5 5L0 0H10L5 5Z" fill="currentColor" />
                      </svg>
                    </a>
                    <div class="header-submenu menu-absolute submenu-color">
                      <ul class="list-unstyled">
                        <li class="nav-item">
                          <a class="menu-link" href="{{ route('front.articles.index') }}">Blog</a>
                        </li>
                        <li class="nav-item">
                          <a class="menu-link" href="{{ route('front.articles.index') }}">
                            Blog Details
                          </a>
                        </li>
                        <li class="nav-item">
                          <a
                            class="menu-link menu-accrodion"
                            href="{{ route('front.articles.index') }}"
                          >
                            Blog Style
                            <svg
                              width="10"
                              height="5"
                              viewBox="0 0 10 5"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path d="M5 5L0 0H10L5 5Z" fill="currentColor" />
                            </svg>
                          </a>
                          <div
                            class="header-grandmenu header-submenu menu-absolute submenu-color"
                          >
                            <ul class="list-unstyled">
                              <li class="nav-item">
                                <a class="menu-link" href="{{ route('front.articles.index') }}"
                                  >Blog Card</a
                                >
                              </li>
                              <li class="nav-item">
                                <a class="menu-link" href="{{ route('front.articles.index') }}"
                                  >Blog List</a
                                >
                              </li>
                            </ul>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="menu-link menu-link-main" href="#contact">
                      Contact
                    </a>
                  </li>
                </ul>
              </nav>
            </drawer-menu>
            <div class="header-actions d-flex align-items-center">
              <drawer-opener
                class="header-search search-open svg-wrapper"
                data-drawer=".modal-search"
              >
                <svg
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M21.7104 20.2875L18.0004 16.6075C19.4405 14.8119 20.1379 12.5328 19.9492 10.2388C19.7605 7.94476 18.7001 5.81025 16.9859 4.27411C15.2718 2.73797 13.0342 1.91697 10.7333 1.97993C8.43243 2.04289 6.24311 2.98502 4.61553 4.6126C2.98795 6.24018 2.04582 8.4295 1.98286 10.7304C1.9199 13.0313 2.7409 15.2688 4.27704 16.983C5.81318 18.6971 7.94769 19.7576 10.2417 19.9463C12.5357 20.135 14.8148 19.4376 16.6104 17.9975L20.2904 21.6775C20.3834 21.7712 20.494 21.8456 20.6158 21.8964C20.7377 21.9471 20.8684 21.9733 21.0004 21.9733C21.1324 21.9733 21.2631 21.9471 21.385 21.8964C21.5068 21.8456 21.6174 21.7712 21.7104 21.6775C21.8906 21.491 21.9914 21.2418 21.9914 20.9825C21.9914 20.7231 21.8906 20.4739 21.7104 20.2875ZM11.0004 17.9975C9.61592 17.9975 8.26255 17.5869 7.1114 16.8178C5.96026 16.0486 5.06305 14.9553 4.53324 13.6762C4.00342 12.3972 3.8648 10.9897 4.1349 9.63183C4.40499 8.27396 5.07168 7.02668 6.05065 6.04772C7.02961 5.06875 8.27689 4.40206 9.63476 4.13197C10.9926 3.86187 12.4001 4.00049 13.6792 4.53031C14.9583 5.06012 16.0515 5.95733 16.8207 7.10847C17.5899 8.25962 18.0004 9.61299 18.0004 10.9975C18.0004 12.854 17.2629 14.6345 15.9501 15.9472C14.6374 17.26 12.8569 17.9975 11.0004 17.9975Z"
                    fill="currentColor"
                    fill-opacity="1"
                  />
                </svg>
              </drawer-opener>

              <modal-search class="theme-modal modal-search">
                <div class="modal-container">
                  <div class="modal-header">
                    <drawer-opener
                      class="svg-wrapper search-close"
                      data-drawer=".modal-search"
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
                  <div
                    class="modal-main d-flex align-items-center justify-content-center"
                  >
                    <form
                      action="#"
                      class="form-search d-flex align-items-center justify-content-center flex-wrap"
                    >
                      <label for="Search" class="text text-30"> Search </label>
                      <input
                        type="text"
                        placeholder="What are you looking for?"
                        name="search"
                        id="Search"
                        class="text text-16"
                        autocomplete="off"
                      />
                      <button
                        class="button button--primary"
                        type="submit"
                        aria-label="Search"
                      >
                        <span class="svg-wrapper">
                          <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M21.7104 20.2875L18.0004 16.6075C19.4405 14.8119 20.1379 12.5328 19.9492 10.2388C19.7605 7.94476 18.7001 5.81025 16.9859 4.27411C15.2718 2.73797 13.0342 1.91697 10.7333 1.97993C8.43243 2.04289 6.24311 2.98502 4.61553 4.6126C2.98795 6.24018 2.04582 8.4295 1.98286 10.7304C1.9199 13.0313 2.7409 15.2688 4.27704 16.983C5.81318 18.6971 7.94769 19.7576 10.2417 19.9463C12.5357 20.135 14.8148 19.4376 16.6104 17.9975L20.2904 21.6775C20.3834 21.7712 20.494 21.8456 20.6158 21.8964C20.7377 21.9471 20.8684 21.9733 21.0004 21.9733C21.1324 21.9733 21.2631 21.9471 21.385 21.8964C21.5068 21.8456 21.6174 21.7712 21.7104 21.6775C21.8906 21.491 21.9914 21.2418 21.9914 20.9825C21.9914 20.7231 21.8906 20.4739 21.7104 20.2875ZM11.0004 17.9975C9.61592 17.9975 8.26255 17.5869 7.1114 16.8178C5.96026 16.0486 5.06305 14.9553 4.53324 13.6762C4.00342 12.3972 3.8648 10.9897 4.1349 9.63183C4.40499 8.27396 5.07168 7.02668 6.05065 6.04772C7.02961 5.06875 8.27689 4.40206 9.63476 4.13197C10.9926 3.86187 12.4001 4.00049 13.6792 4.53031C14.9583 5.06012 16.0515 5.95733 16.8207 7.10847C17.5899 8.25962 18.0004 9.61299 18.0004 10.9975C18.0004 12.854 17.2629 14.6345 15.9501 15.9472C14.6374 17.26 12.8569 17.9975 11.0004 17.9975Z"
                              fill="currentColor"
                              fill-opacity="1"
                            />
                          </svg>
                        </span>
                      </button>
                    </form>
                  </div>
                </div>
              </modal-search>

              <div class="header-separator">
                <svg
                  width="11"
                  height="53"
                  viewBox="0 0 11 53"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <line
                    x1="10.5"
                    x2="10.5"
                    y2="53"
                    stroke="currentColor"
                    stroke-opacity="0.7"
                  />
                  <line
                    x1="0.5"
                    y1="12"
                    x2="0.5"
                    y2="42"
                    stroke="currentColor"
                    stroke-opacity="0.3"
                  />
                </svg>
              </div>
              <a
                href="#contact"
                aria-label="contact us"
                class="button button--secondary button--slim d-none d-lg-inline-flex"
              >
                Let's Talk
                <span class="svg-wrapper">
                  <svg
                    class="icon-20"
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z"
                      fill="currentColor"
                    ></path>
                  </svg>
                </span>
              </a>
              <drawer-opener
                class="svg-wrapper menu-open d-lg-none"
                data-drawer=".drawer-menu"
              >
                <svg
                  width="52"
                  height="52"
                  viewBox="0 0 52 52"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <circle
                    cx="26"
                    cy="26"
                    r="25.5"
                    fill="white"
                    stroke="currentColor"
                  />
                  <path
                    d="M32.5 18.2857C32.5 17.5757 31.9179 17 31.2 17H14.3C13.5821 17 13 17.5757 13 18.2857C13 18.9958 13.5821 19.5714 14.3 19.5714H31.2C31.9179 19.5714 32.5 18.9957 32.5 18.2857ZM14.3 24.7143H37.7C38.4179 24.7143 39 25.29 39 26C39 26.7101 38.4179 27.2857 37.7 27.2857H14.3C13.5821 27.2857 13 26.7101 13 26C13 25.29 13.5821 24.7143 14.3 24.7143ZM14.3 32.4286H26C26.7179 32.4286 27.3 33.0042 27.3 33.7143C27.3 34.4243 26.7179 35 26 35H14.3C13.5821 35 13 34.4243 13 33.7143C13 33.0042 13.5821 32.4286 14.3 32.4286Z"
                    fill="currentColor"
                  />
                </svg>
              </drawer-opener>
            </div>
          </div>
        </div>
      </header>
    </sticky-header>

    <!-- Main -->
    <main>
      <!-- Hero Slider -->
      <new-banner class="hero-slider slider-with-thumb with-floating-header">
        <div class="main-slider" data-aos="fade-down">
          <div class="swiper">
            <div class="swiper-wrapper">
              <!-- Slides -->
              <div class="swiper-slide">
                <div class="slider-card overlay">
                  <picture class="slider-media">
                    <source
                      media="(max-width: 575px)"
                      srcset="{{ asset('front-assets/consulo') }}/img/slider/hero-4-575.jpg"
                    />
                    <source
                      media="(max-width: 991px)"
                      srcset="{{ asset('front-assets/consulo') }}/img/slider/hero-4-991.jpg"
                    />
                    <img
                      src="{{ $heroOne ? Storage::url($heroOne) : ($primaryActivity?->coverImage ? Storage::url($primaryActivity->coverImage->image_path) : asset('front-assets/consulo/img/slider/hero-4.jpg')) }}"
                      width="1920"
                      height="1280"
                      loading="eager"
                      alt="Hero Image"
                    />
                  </picture>
                  <div class="slider-content">
                    <div
                      class="container-fluid height-100 d-flex align-items-center"
                    >
                      <div
                        class="content-box slider-animation section-headings"
                      >
                        <div class="subheading text-20 subheading-bg">
                          <svg
                            class="icon icon-14"
                            xmlns="http://www.w3.org/2000/svg"
                            width="14"
                            height="14"
                            viewBox="0 0 14 14"
                            fill="none"
                          >
                            <g clip-path="url(#clip0_9088_414319)">
                              <path
                                d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                                fill="CurrentColor"
                              />
                            </g>
                            <defs>
                              <clipPath>
                                <rect
                                  width="14"
                                  height="14"
                                  fill="CurrentColor"
                                />
                              </clipPath>
                            </defs>
                          </svg>
                          <span>{{ $settings->company_name ?? 'EYWEP' }}</span>
                          <svg
                            class="icon icon-14"
                            xmlns="http://www.w3.org/2000/svg"
                            width="14"
                            height="14"
                            viewBox="0 0 14 14"
                            fill="none"
                          >
                            <g clip-path="url(#clip0_9088_4143)z">
                              <path
                                d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                                fill="CurrentColor"
                              />
                            </g>
                            <defs>
                              <clipPath>
                                <rect
                                  width="14"
                                  height="14"
                                  fill="CurrentColor"
                                />
                              </clipPath>
                            </defs>
                          </svg>
                        </div>
                        <h2 class="heading text-90 fw-700">
                          {{ $settings->hero_title ?? 'Business Strategy That Works' }}
                        </h2>
                        <div class="text text-18">
                          {{ $settings->hero_subtitle ?? ($settings->company_slogan ?? 'Notre programme valorise les activites, les ressources, les temoignages et les actualites entrepreneuriales.') }}
                        </div>
                        <div class="buttons">
                          <a
                            href="{{ route('front.activities.index') }}"
                            class="button button--secondary"
                            aria-label="hero button"
                          >
                            Decouvrir le programme
                            <span class="svg-wrapper">
                              <svg
                                class="icon-20"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z"
                                  fill="currentColor"
                                />
                              </svg>
                            </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="slider-card overlay">
                  <picture class="slider-media">
                    <source
                      media="(max-width: 575px)"
                      srcset="{{ asset('front-assets/consulo') }}/img/slider/hero4-2-575.jpg"
                    />
                    <source
                      media="(max-width: 991px)"
                      srcset="{{ asset('front-assets/consulo') }}/img/slider/hero4-2-991.jpg"
                    />
                    <img
                      src="{{ $heroTwo ? Storage::url($heroTwo) : ($secondaryActivity?->coverImage ? Storage::url($secondaryActivity->coverImage->image_path) : asset('front-assets/consulo/img/slider/hero4-2.jpg')) }}"
                      width="1920"
                      height="1282"
                      loading="lazy"
                      alt="Hero Image"
                    />
                  </picture>
                  <div class="slider-content">
                    <div
                      class="container-fluid height-100 d-flex align-items-center"
                    >
                      <div
                        class="content-box slider-animation section-headings"
                      >
                        <div class="subheading text-20 subheading-bg">
                          <svg
                            class="icon icon-14"
                            xmlns="http://www.w3.org/2000/svg"
                            width="14"
                            height="14"
                            viewBox="0 0 14 14"
                            fill="none"
                          >
                            <g clip-path="url(#clip0_9088_41432)">
                              <path
                                d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                                fill="CurrentColor"
                              />
                            </g>
                            <defs>
                              <clipPath>
                                <rect
                                  width="14"
                                  height="14"
                                  fill="CurrentColor"
                                />
                              </clipPath>
                            </defs>
                          </svg>
                          <span>Activites et terrain</span>
                          <svg
                            class="icon icon-14"
                            xmlns="http://www.w3.org/2000/svg"
                            width="14"
                            height="14"
                            viewBox="0 0 14 14"
                            fill="none"
                          >
                            <g clip-path="url(#clip0_9088_41433)">
                              <path
                                d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                                fill="CurrentColor"
                              />
                            </g>
                            <defs>
                              <clipPath>
                                <rect
                                  width="14"
                                  height="14"
                                  fill="CurrentColor"
                                />
                              </clipPath>
                            </defs>
                          </svg>
                        </div>
                        <h2 class="heading text-90 fw-700">
                          {{ $primaryActivity?->titre ?? 'Financial Clarity with Data' }}
                        </h2>
                        <div class="text text-18">
                          {{ \Illuminate\Support\Str::limit(strip_tags($primaryActivity?->description ?? 'Les activites du programme illustrent les actions menees sur le terrain et leur impact.'), 180) }}
                        </div>
                        <div class="buttons">
                          <a
                            href="{{ route('front.activities.index') }}"
                            class="button button--secondary"
                            aria-label="hero button"
                          >
                            Voir les activites
                            <span class="svg-wrapper">
                              <svg
                                class="icon-20"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z"
                                  fill="currentColor"
                                />
                              </svg>
                            </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="slider-card overlay">
                  <picture class="slider-media">
                    <source
                      media="(max-width: 575px)"
                      srcset="{{ asset('front-assets/consulo') }}/img/slider/hero4-3-575.jpg"
                    />
                    <source
                      media="(max-width: 991px)"
                      srcset="{{ asset('front-assets/consulo') }}/img/slider/hero4-3-991.jpg"
                    />
                    <img
                      src="{{ $heroThree ? Storage::url($heroThree) : ($primaryStory?->coverImage ? Storage::url($primaryStory->coverImage->image_path) : asset('front-assets/consulo/img/slider/hero4-3.jpg')) }}"
                      width="1920"
                      height="1080"
                      loading="eager"
                      alt="Hero Image"
                    />
                  </picture>
                  <div class="slider-content">
                    <div
                      class="container-fluid height-100 d-flex align-items-center"
                    >
                      <div
                        class="content-box slider-animation section-headings"
                      >
                        <div class="subheading text-20 subheading-bg">
                          <svg
                            class="icon icon-14"
                            xmlns="http://www.w3.org/2000/svg"
                            width="14"
                            height="14"
                            viewBox="0 0 14 14"
                            fill="none"
                          >
                            <g clip-path="url(#clip0_9088_414319)">
                              <path
                                d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                                fill="CurrentColor"
                              />
                            </g>
                            <defs>
                              <clipPath>
                                <rect
                                  width="14"
                                  height="14"
                                  fill="CurrentColor"
                                />
                              </clipPath>
                            </defs>
                          </svg>
                          <span>Temoignages et impact</span>
                          <svg
                            class="icon icon-14"
                            xmlns="http://www.w3.org/2000/svg"
                            width="14"
                            height="14"
                            viewBox="0 0 14 14"
                            fill="none"
                          >
                            <g clip-path="url(#clip0_9088_4143)z">
                              <path
                                d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                                fill="CurrentColor"
                              />
                            </g>
                            <defs>
                              <clipPath>
                                <rect
                                  width="14"
                                  height="14"
                                  fill="CurrentColor"
                                />
                              </clipPath>
                            </defs>
                          </svg>
                        </div>
                        <h2 class="heading text-90 fw-700">
                          {{ $primaryStory?->titre ?? 'Planning for Smarter Growth' }}
                        </h2>
                        <div class="text text-18">
                          {{ \Illuminate\Support\Str::limit(strip_tags($primaryStory?->description ?? 'Les temoignages montrent les parcours, les reussites et les transformations rendues possibles par le programme.'), 180) }}
                        </div>
                        <div class="buttons">
                          <a
                            href="{{ route('front.activities.index') }}"
                            class="button button--secondary"
                            aria-label="hero button"
                          >
                            Voir les temoignages
                            <span class="svg-wrapper">
                              <svg
                                class="icon-20"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z"
                                  fill="currentColor"
                                />
                              </svg>
                            </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid position-relative">
          <div class="thumb-slider">
            <div class="swiper">
              <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide" data-aos="fade-left">
                  <div class="thumb-img">
                    <img
                      src="{{ asset('front-assets/consulo') }}/img/slider/s4.jpg"
                      width="120"
                      height="120"
                      loading="lazy"
                      alt="Slider image"
                    />
                  </div>
                </div>
                <div class="swiper-slide" data-aos="zoom-in">
                  <div class="thumb-img">
                    <img
                      src="{{ asset('front-assets/consulo') }}/img/slider/s4-2.jpg"
                      width="120"
                      height="120"
                      loading="lazy"
                      alt="Slider image"
                    />
                  </div>
                </div>
                <div class="swiper-slide" data-aos="fade-right">
                  <div class="thumb-img">
                    <img
                      src="{{ asset('front-assets/consulo') }}/img/slider/s4-3.jpg"
                      width="120"
                      height="120"
                      loading="lazy"
                      alt="Slider image"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </new-banner>

      <!-- Our Services -->
      <div class="multicolumn section-padding">
        <div class="media media-bg">
          <img
            src="{{ asset('front-assets/consulo') }}/img/contact/contact-bg.jpg"
            width="1920"
            height="883"
            loading="lazy"
            alt="Background image"
          />
        </div>
        <div class="container">
          <div class="multicolumn-header section-headings">
            <div class="subheading text-20 subheading-bg" data-aos="fade-up">
              <svg
                class="icon icon-14"
                xmlns="http://www.w3.org/2000/svg"
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
              >
                <g clip-path="url(#clip0_9088_4143)">
                  <path
                    d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                    fill="CurrentColor"
                  />
                </g>
                <defs>
                  <clipPath>
                    <rect width="14" height="14" fill="CurrentColor" />
                  </clipPath>
                </defs>
              </svg>
              <span>Nos activites</span>
              <svg
                class="icon icon-14"
                xmlns="http://www.w3.org/2000/svg"
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
              >
                <g clip-path="url(#clip0_9088_4143)">
                  <path
                    d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                    fill="CurrentColor"
                  />
                </g>
                <defs>
                  <clipPath>
                    <rect width="14" height="14" fill="CurrentColor" />
                  </clipPath>
                </defs>
              </svg>
            </div>
            <h2 class="heading text-50" data-aos="fade-up">
              Les activites du programme mises en avant
            </h2>
          </div>
          <div class="service-slider section-content">
            <div class="row product-grid justify-content-center">
              <div class="col-xl-4 col-md-6 col-12">
                <a
                  href="{{ route('front.activities.index') }}"
                  class="card-service image-card-service radius18 d-flex justify-content-center"
                  aria-label="Service Card"
                  data-aos="fade-up"
                >
                  <img
                    src="{{ $primaryActivity?->coverImage ? Storage::url($primaryActivity->coverImage->image_path) : asset('front-assets/consulo/img/service/s3.jpg') }}"
                    alt="{{ $primaryActivity?->titre ?? 'service image' }}"
                    width="1000"
                    height="596"
                    loading="lazy"
                  />
                  <div class="card-service-content-absolute">
                    <div class="card-service-content">
                      <div class="card-working-process">
                        <h2 class="heading text-24 fw-500">
                          {{ $primaryActivity?->titre ?? 'Business Consulting' }}
                        </h2>
                        <div class="card-icon-text card-icon-text-horizontal">
                          <div class="content">
                            <p class="text text-16">
                              {{ \Illuminate\Support\Str::limit(strip_tags($primaryActivity?->description ?? 'Helping businesses grow through strategic planning, expert guidance, and measurable results.'), 120) }}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-xl-4 col-md-6 col-12">
                <a
                  href="{{ route('front.activities.index') }}"
                  class="card-service image-card-service radius18 d-flex justify-content-center"
                  aria-label="Service Card"
                  data-aos="fade-up"
                >
                  <img
                    src="{{ $secondaryActivity?->coverImage ? Storage::url($secondaryActivity->coverImage->image_path) : asset('front-assets/consulo/img/service/s4.jpg') }}"
                    alt="{{ $secondaryActivity?->titre ?? 'service image' }}"
                    width="1000"
                    height="596"
                    loading="lazy"
                  />
                  <div class="card-service-content-absolute">
                    <div class="card-service-content">
                      <div class="card-working-process">
                        <h2 class="heading text-24 fw-500">{{ $secondaryActivity?->titre ?? 'Plan development' }}</h2>
                        <div class="card-icon-text card-icon-text-horizontal">
                          <div class="content">
                            <p class="text text-16">
                              {{ \Illuminate\Support\Str::limit(strip_tags($secondaryActivity?->description ?? 'Creating structured, actionable plans that guide businesses toward growth and successful outcomes.'), 120) }}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-xl-4 col-md-6 col-12">
                <a
                  href="{{ route('front.activities.index') }}"
                  class="card-service image-card-service radius18 d-flex justify-content-center"
                  aria-label="Service Card"
                  data-aos="fade-up"
                >
                  <img
                    src="{{ $tertiaryActivity?->coverImage ? Storage::url($tertiaryActivity->coverImage->image_path) : asset('front-assets/consulo/img/service/s5.jpg') }}"
                    alt="{{ $tertiaryActivity?->titre ?? 'service image' }}"
                    width="1000"
                    height="596"
                    loading="lazy"
                  />
                  <div class="card-service-content-absolute">
                    <div class="card-service-content">
                      <div class="card-working-process">
                        <h2 class="heading text-24 fw-500">{{ $tertiaryActivity?->titre ?? 'Finance strategy' }}</h2>
                        <div class="card-icon-text card-icon-text-horizontal">
                          <div class="content">
                            <p class="text text-16">
                              {{ \Illuminate\Support\Str::limit(strip_tags($tertiaryActivity?->description ?? 'Designing smart financial plans that optimize resources, reduce risks, and drive growth.'), 120) }}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>

          <div class="section-headings text-center">
            <div class="buttons" data-aos="fade-up">
              <a
                href="{{ route('front.activities.index') }}"
                class="button button--primary"
                aria-label="More Services"
              >
                Toutes les activites
                <span class="svg-wrapper">
                  <svg
                    class="icon-20"
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z"
                      fill="CurrentColor"
                    />
                  </svg>
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Projects -->
      <div class="recent-project project-grid mt-100">
        <div class="container">
          <div class="section-headings headings-width text-center">
            <div class="subheading text-20 subheading-bg" data-aos="fade-up">
              <svg
                class="icon icon-14"
                xmlns="http://www.w3.org/2000/svg"
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
              >
                <g clip-path="url(#clip0_9088_4143)">
                  <path
                    d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                    fill="CurrentColor"
                  />
                </g>
                <defs>
                  <clipPath>
                    <rect width="14" height="14" fill="CurrentColor" />
                  </clipPath>
                </defs>
              </svg>
              <span>Recent Projects</span>
              <svg
                class="icon icon-14"
                xmlns="http://www.w3.org/2000/svg"
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
              >
                <g clip-path="url(#clip0_9088_4143)">
                  <path
                    d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                    fill="CurrentColor"
                  />
                </g>
                <defs>
                  <clipPath>
                    <rect width="14" height="14" fill="CurrentColor" />
                  </clipPath>
                </defs>
              </svg>
            </div>
            <h2 class="heading text-50" data-aos="fade-up" data-aos-delay="100">
              Explore the Recent Works We Have Done!
            </h2>
          </div>
          <div class="section-content">
            <div class="row product-grid justify-content-center">
              <div class="col-lg-5 col-12" data-aos="fade-right">
                <a
                  class="card-project radius18"
                  aria-label="project details"
                  href="{{ route('front.galleries.index') }}"
                >
                  <img
                    src="{{ asset('front-assets/consulo') }}/img/project/1.jpg"
                    alt="project image"
                    width="1000"
                    height="707"
                    loading="lazy"
                  />
                  <div class="card-project-content-absolute">
                    <div class="card-project-content">
                      <h2 class="heading text-24">Performance Enhancement</h2>
                      <div class="text text-16 mt-3">
                        By evaluating systems, resources, and performance
                        metrics, we enable organizations to operate at peak
                        efficiency while maintaining quality and scalability.
                      </div>
                    </div>
                  </div>
                  <span class="svg-wrapper icon-project-link d-none d-sm-block">
                    <svg
                      viewBox="0 0 64 64"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <circle cx="32" cy="32" r="32" fill="white" />
                      <path
                        d="M26.1667 39C25.8167 39 25.5833 38.8833 25.35 38.65C24.8833 38.1833 24.8833 37.4833 25.35 37.0167L37.0167 25.35C37.4833 24.8833 38.1833 24.8833 38.65 25.35C39.1167 25.8167 39.1167 26.5167 38.65 26.9833L26.9833 38.65C26.75 38.8833 26.5167 39 26.1667 39Z"
                        fill="#20282D"
                      />
                      <path
                        d="M37.8332 37.8333C37.1332 37.8333 36.6665 37.3667 36.6665 36.6667V27.3333H27.3332C26.6332 27.3333 26.1665 26.8667 26.1665 26.1667C26.1665 25.4667 26.6332 25 27.3332 25H37.8332C38.5332 25 38.9998 25.4667 38.9998 26.1667V36.6667C38.9998 37.3667 38.5332 37.8333 37.8332 37.8333Z"
                        fill="#20282D"
                      />
                    </svg>
                  </span>
                </a>
              </div>
              <div class="col-lg-7 col-12" data-aos="fade-left">
                <a
                  class="card-project radius18"
                  aria-label="project details"
                  href="{{ route('front.galleries.index') }}"
                >
                  <img
                    src="{{ asset('front-assets/consulo') }}/img/project/2.jpg"
                    alt="project image"
                    width="1000"
                    height="707"
                    loading="lazy"
                  />
                  <div class="card-project-content-absolute">
                    <div class="card-project-content">
                      <h2 class="heading text-24">Operational Excellence</h2>
                      <div class="text text-16 mt-3">
                        We help organizations achieve operational excellence
                        through streamlined workflows, cost optimization, and
                        continuous performance improvement.
                      </div>
                    </div>
                  </div>
                  <span class="svg-wrapper icon-project-link d-none d-sm-block">
                    <svg
                      viewBox="0 0 64 64"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <circle cx="32" cy="32" r="32" fill="white" />
                      <path
                        d="M26.1667 39C25.8167 39 25.5833 38.8833 25.35 38.65C24.8833 38.1833 24.8833 37.4833 25.35 37.0167L37.0167 25.35C37.4833 24.8833 38.1833 24.8833 38.65 25.35C39.1167 25.8167 39.1167 26.5167 38.65 26.9833L26.9833 38.65C26.75 38.8833 26.5167 39 26.1667 39Z"
                        fill="#20282D"
                      />
                      <path
                        d="M37.8332 37.8333C37.1332 37.8333 36.6665 37.3667 36.6665 36.6667V27.3333H27.3332C26.6332 27.3333 26.1665 26.8667 26.1665 26.1667C26.1665 25.4667 26.6332 25 27.3332 25H37.8332C38.5332 25 38.9998 25.4667 38.9998 26.1667V36.6667C38.9998 37.3667 38.5332 37.8333 37.8332 37.8333Z"
                        fill="#20282D"
                      />
                    </svg>
                  </span>
                </a>
              </div>
              <div class="col-lg-7 col-12" data-aos="fade-up-right">
                <a
                  class="card-project radius18"
                  aria-label="project details"
                  href="{{ route('front.galleries.index') }}"
                >
                  <img
                    src="{{ asset('front-assets/consulo') }}/img/project/3.jpg"
                    alt="project image"
                    width="1000"
                    height="707"
                    loading="lazy"
                  />
                  <div class="card-project-content-absolute">
                    <div class="card-project-content">
                      <h2 class="heading text-24">Innovation Planning</h2>
                      <div class="text text-16 mt-3">
                        Designing forward-thinking strategies that help
                        businesses innovate, adapt, and stay competitive in
                        evolving markets.
                      </div>
                    </div>
                  </div>
                  <span class="svg-wrapper icon-project-link d-none d-sm-block">
                    <svg
                      viewBox="0 0 64 64"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <circle cx="32" cy="32" r="32" fill="white" />
                      <path
                        d="M26.1667 39C25.8167 39 25.5833 38.8833 25.35 38.65C24.8833 38.1833 24.8833 37.4833 25.35 37.0167L37.0167 25.35C37.4833 24.8833 38.1833 24.8833 38.65 25.35C39.1167 25.8167 39.1167 26.5167 38.65 26.9833L26.9833 38.65C26.75 38.8833 26.5167 39 26.1667 39Z"
                        fill="#20282D"
                      />
                      <path
                        d="M37.8332 37.8333C37.1332 37.8333 36.6665 37.3667 36.6665 36.6667V27.3333H27.3332C26.6332 27.3333 26.1665 26.8667 26.1665 26.1667C26.1665 25.4667 26.6332 25 27.3332 25H37.8332C38.5332 25 38.9998 25.4667 38.9998 26.1667V36.6667C38.9998 37.3667 38.5332 37.8333 37.8332 37.8333Z"
                        fill="#20282D"
                      />
                    </svg>
                  </span>
                </a>
              </div>
              <div class="col-lg-5 col-12" data-aos="fade-up-left">
                <a
                  class="card-project radius18"
                  aria-label="project details"
                  href="{{ route('front.galleries.index') }}"
                >
                  <img
                    src="{{ asset('front-assets/consulo') }}/img/project/5.jpg"
                    alt="project image"
                    width="1000"
                    height="707"
                    loading="lazy"
                  />
                  <div class="card-project-content-absolute">
                    <div class="card-project-content">
                      <h2 class="heading text-24">Operational Excellence</h2>
                      <div class="text text-16 mt-3">
                        Building efficient, scalable operations that support
                        long-term growth and organizational success.
                      </div>
                    </div>
                  </div>
                  <span class="svg-wrapper icon-project-link d-none d-sm-block">
                    <svg
                      viewBox="0 0 64 64"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <circle cx="32" cy="32" r="32" fill="white" />
                      <path
                        d="M26.1667 39C25.8167 39 25.5833 38.8833 25.35 38.65C24.8833 38.1833 24.8833 37.4833 25.35 37.0167L37.0167 25.35C37.4833 24.8833 38.1833 24.8833 38.65 25.35C39.1167 25.8167 39.1167 26.5167 38.65 26.9833L26.9833 38.65C26.75 38.8833 26.5167 39 26.1667 39Z"
                        fill="#20282D"
                      />
                      <path
                        d="M37.8332 37.8333C37.1332 37.8333 36.6665 37.3667 36.6665 36.6667V27.3333H27.3332C26.6332 27.3333 26.1665 26.8667 26.1665 26.1667C26.1665 25.4667 26.6332 25 27.3332 25H37.8332C38.5332 25 38.9998 25.4667 38.9998 26.1667V36.6667C38.9998 37.3667 38.5332 37.8333 37.8332 37.8333Z"
                        fill="#20282D"
                      />
                    </svg>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <div class="section-button" data-aos="fade-up">
            <a
              href="{{ route('front.galleries.index') }}"
              class="button button--primary"
              aria-label="Discover more Project"
            >
              Discover More
              <span class="svg-wrapper">
                <svg
                  class="icon-20"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z"
                    fill="CurrentColor"
                  />
                </svg>
              </span>
            </a>
          </div>
        </div>
      </div>

      <!-- Working Process -->
      <div class="faq-2 faq-working-process section-padding mt-100">
        <div class="container">
          <div class="section-headings headings-width text-center">
            <div class="subheading text-20 subheading-bg" data-aos="fade-up">
              <svg
                class="icon icon-14"
                xmlns="http://www.w3.org/2000/svg"
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
              >
                <g clip-path="url(#clip0_9088_4143)">
                  <path
                    d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                    fill="CurrentColor"
                  />
                </g>
                <defs>
                  <clipPath>
                    <rect width="14" height="14" fill="CurrentColor" />
                  </clipPath>
                </defs>
              </svg>
              <span>Working Process</span>
              <svg
                class="icon icon-14"
                xmlns="http://www.w3.org/2000/svg"
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
              >
                <g clip-path="url(#clip0_9088_4143)">
                  <path
                    d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                    fill="CurrentColor"
                  />
                </g>
                <defs>
                  <clipPath>
                    <rect width="14" height="14" fill="CurrentColor" />
                  </clipPath>
                </defs>
              </svg>
            </div>
            <h2 class="heading text-50" data-aos="fade-up" data-aos-delay="100">
              How We Bring Your Ideas to Life
            </h2>
          </div>
          <div class="section-content">
            <faq-accordion>
              <div class="accordion-list">
                <div class="accordion-block" data-aos="fade-up">
                  <div class="accordion-opener">
                    <div class="heading-index">
                      <span class="text text-24">01.</span>
                      <h2 class="heading text-24">Listen & Discover</h2>
                    </div>
                    <div class="svg-wrapper">
                      <svg
                        class="icon icon-32"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <g clip-path="url(#clip0_9088_8345)">
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.7083 15.7044C12.5208 15.8919 12.2665 15.9972 12.0013 15.9972C11.7362 15.9972 11.4818 15.8919 11.2943 15.7044L5.63732 10.0474C5.54181 9.95517 5.46563 9.84482 5.41322 9.72282C5.36081 9.60081 5.33322 9.46959 5.33207 9.33681C5.33092 9.20404 5.35622 9.07236 5.4065 8.94946C5.45678 8.82656 5.53103 8.71491 5.62492 8.62102C5.71882 8.52713 5.83047 8.45287 5.95337 8.40259C6.07626 8.35231 6.20794 8.32701 6.34072 8.32816C6.4735 8.32932 6.60472 8.3569 6.72672 8.40931C6.84873 8.46172 6.95907 8.5379 7.05132 8.63341L12.0013 13.5834L16.9513 8.63341C17.1399 8.45125 17.3925 8.35046 17.6547 8.35274C17.9169 8.35502 18.1677 8.46019 18.3531 8.64559C18.5385 8.831 18.6437 9.08182 18.646 9.34401C18.6483 9.60621 18.5475 9.85881 18.3653 10.0474L12.7083 15.7044Z"
                            fill="CurrentColor"
                          />
                        </g>
                        <defs>
                          <clipPath>
                            <rect width="24" height="24" fill="CurrentColor" />
                          </clipPath>
                        </defs>
                      </svg>
                    </div>
                  </div>
                  <div class="accordion-content">
                    <div class="accordion-content-inner text text-16">
                      We begin by gaining a deep understanding of your goals,
                      challenges, and long-term vision. Through meaningful
                      conversations and structured discovery sessions, we
                      uncover key insights about your business, market, and
                      opportunities. These insights allow us to craft a tailored
                      strategy designed to address your unique needs and support
                      sustainable growth.
                    </div>
                  </div>
                </div>
                <div
                  class="accordion-block"
                  data-aos="fade-up"
                  data-aos-delay="50"
                >
                  <div class="accordion-opener">
                    <div class="heading-index">
                      <span class="text text-24">02.</span>
                      <h2 class="heading text-24">Research & Analyze</h2>
                    </div>
                    <div class="svg-wrapper">
                      <svg
                        class="icon icon-32"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <g clip-path="url(#clip0_9088_8345)">
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.7083 15.7044C12.5208 15.8919 12.2665 15.9972 12.0013 15.9972C11.7362 15.9972 11.4818 15.8919 11.2943 15.7044L5.63732 10.0474C5.54181 9.95517 5.46563 9.84482 5.41322 9.72282C5.36081 9.60081 5.33322 9.46959 5.33207 9.33681C5.33092 9.20404 5.35622 9.07236 5.4065 8.94946C5.45678 8.82656 5.53103 8.71491 5.62492 8.62102C5.71882 8.52713 5.83047 8.45287 5.95337 8.40259C6.07626 8.35231 6.20794 8.32701 6.34072 8.32816C6.4735 8.32932 6.60472 8.3569 6.72672 8.40931C6.84873 8.46172 6.95907 8.5379 7.05132 8.63341L12.0013 13.5834L16.9513 8.63341C17.1399 8.45125 17.3925 8.35046 17.6547 8.35274C17.9169 8.35502 18.1677 8.46019 18.3531 8.64559C18.5385 8.831 18.6437 9.08182 18.646 9.34401C18.6483 9.60621 18.5475 9.85881 18.3653 10.0474L12.7083 15.7044Z"
                            fill="CurrentColor"
                          />
                        </g>
                        <defs>
                          <clipPath>
                            <rect width="24" height="24" fill="CurrentColor" />
                          </clipPath>
                        </defs>
                      </svg>
                    </div>
                  </div>
                  <div class="accordion-content">
                    <div class="accordion-content-inner text text-16">
                      Our team dives deep into data, industry trends, and
                      audience insights to uncover meaningful opportunities.
                      Through detailed analysis and careful evaluation, we
                      identify patterns, risks, and growth potential. This
                      thorough approach builds a strong strategic foundation and
                      enables informed, confident decision-making at every
                      stage.
                    </div>
                  </div>
                </div>
                <div
                  class="accordion-block"
                  data-aos="fade-up"
                  data-aos-delay="100"
                >
                  <div class="accordion-opener">
                    <div class="heading-index">
                      <span class="text text-24">03.</span>
                      <h2 class="heading text-24">Strategize & Plan</h2>
                    </div>
                    <div class="svg-wrapper">
                      <svg
                        class="icon icon-32"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <g clip-path="url(#clip0_9088_8345)">
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.7083 15.7044C12.5208 15.8919 12.2665 15.9972 12.0013 15.9972C11.7362 15.9972 11.4818 15.8919 11.2943 15.7044L5.63732 10.0474C5.54181 9.95517 5.46563 9.84482 5.41322 9.72282C5.36081 9.60081 5.33322 9.46959 5.33207 9.33681C5.33092 9.20404 5.35622 9.07236 5.4065 8.94946C5.45678 8.82656 5.53103 8.71491 5.62492 8.62102C5.71882 8.52713 5.83047 8.45287 5.95337 8.40259C6.07626 8.35231 6.20794 8.32701 6.34072 8.32816C6.4735 8.32932 6.60472 8.3569 6.72672 8.40931C6.84873 8.46172 6.95907 8.5379 7.05132 8.63341L12.0013 13.5834L16.9513 8.63341C17.1399 8.45125 17.3925 8.35046 17.6547 8.35274C17.9169 8.35502 18.1677 8.46019 18.3531 8.64559C18.5385 8.831 18.6437 9.08182 18.646 9.34401C18.6483 9.60621 18.5475 9.85881 18.3653 10.0474L12.7083 15.7044Z"
                            fill="CurrentColor"
                          />
                        </g>
                        <defs>
                          <clipPath>
                            <rect width="24" height="24" fill="CurrentColor" />
                          </clipPath>
                        </defs>
                      </svg>
                    </div>
                  </div>
                  <div class="accordion-content">
                    <div class="accordion-content-inner text text-16">
                      With clear insights, we develop a structured,
                      results-focused roadmap. This strategy outlines goals,
                      timelines, and steps, ensuring your project moves forward
                      with direction, confidence, and measurable objectives.
                    </div>
                  </div>
                </div>
                <div
                  class="accordion-block"
                  data-aos="fade-up"
                  data-aos-delay="150"
                >
                  <div class="accordion-opener">
                    <div class="heading-index">
                      <span class="text text-24">04.</span>
                      <h2 class="heading text-24">Design & Create</h2>
                    </div>
                    <div class="svg-wrapper">
                      <svg
                        class="icon icon-32"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <g clip-path="url(#clip0_9088_8345)">
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.7083 15.7044C12.5208 15.8919 12.2665 15.9972 12.0013 15.9972C11.7362 15.9972 11.4818 15.8919 11.2943 15.7044L5.63732 10.0474C5.54181 9.95517 5.46563 9.84482 5.41322 9.72282C5.36081 9.60081 5.33322 9.46959 5.33207 9.33681C5.33092 9.20404 5.35622 9.07236 5.4065 8.94946C5.45678 8.82656 5.53103 8.71491 5.62492 8.62102C5.71882 8.52713 5.83047 8.45287 5.95337 8.40259C6.07626 8.35231 6.20794 8.32701 6.34072 8.32816C6.4735 8.32932 6.60472 8.3569 6.72672 8.40931C6.84873 8.46172 6.95907 8.5379 7.05132 8.63341L12.0013 13.5834L16.9513 8.63341C17.1399 8.45125 17.3925 8.35046 17.6547 8.35274C17.9169 8.35502 18.1677 8.46019 18.3531 8.64559C18.5385 8.831 18.6437 9.08182 18.646 9.34401C18.6483 9.60621 18.5475 9.85881 18.3653 10.0474L12.7083 15.7044Z"
                            fill="CurrentColor"
                          />
                        </g>
                        <defs>
                          <clipPath>
                            <rect width="24" height="24" fill="CurrentColor" />
                          </clipPath>
                        </defs>
                      </svg>
                    </div>
                  </div>
                  <div class="accordion-content">
                    <div class="accordion-content-inner text text-16">
                      We craft innovative, customer-focused solutions tailored
                      to your business objectives. From creative concepts to
                      functional design, our approach blends strategy,
                      creativity, and usability to deliver meaningful
                      experiences. Every solution is thoughtfully designed to
                      reflect your vision while driving real value and
                      measurable impact.
                    </div>
                  </div>
                </div>
                <div
                  class="accordion-block"
                  data-aos="fade-up"
                  data-aos-delay="200"
                >
                  <div class="accordion-opener">
                    <div class="heading-index">
                      <span class="text text-24">05.</span>
                      <h2 class="heading text-24">Test & Refine</h2>
                    </div>
                    <div class="svg-wrapper">
                      <svg
                        class="icon icon-32"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <g clip-path="url(#clip0_9088_8345)">
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.7083 15.7044C12.5208 15.8919 12.2665 15.9972 12.0013 15.9972C11.7362 15.9972 11.4818 15.8919 11.2943 15.7044L5.63732 10.0474C5.54181 9.95517 5.46563 9.84482 5.41322 9.72282C5.36081 9.60081 5.33322 9.46959 5.33207 9.33681C5.33092 9.20404 5.35622 9.07236 5.4065 8.94946C5.45678 8.82656 5.53103 8.71491 5.62492 8.62102C5.71882 8.52713 5.83047 8.45287 5.95337 8.40259C6.07626 8.35231 6.20794 8.32701 6.34072 8.32816C6.4735 8.32932 6.60472 8.3569 6.72672 8.40931C6.84873 8.46172 6.95907 8.5379 7.05132 8.63341L12.0013 13.5834L16.9513 8.63341C17.1399 8.45125 17.3925 8.35046 17.6547 8.35274C17.9169 8.35502 18.1677 8.46019 18.3531 8.64559C18.5385 8.831 18.6437 9.08182 18.646 9.34401C18.6483 9.60621 18.5475 9.85881 18.3653 10.0474L12.7083 15.7044Z"
                            fill="CurrentColor"
                          />
                        </g>
                        <defs>
                          <clipPath>
                            <rect width="24" height="24" fill="CurrentColor" />
                          </clipPath>
                        </defs>
                      </svg>
                    </div>
                  </div>
                  <div class="accordion-content">
                    <div class="accordion-content-inner text text-16">
                      Before launch, we thoroughly test every detail to ensure
                      quality, functionality, and performance. Using feedback
                      and real-world performance data, we refine and optimize
                      each element to deliver a polished, effective result that
                      aligns seamlessly with your goals and expectations.
                    </div>
                  </div>
                </div>
                <div
                  class="accordion-block"
                  data-aos="fade-up"
                  data-aos-delay="250"
                >
                  <div class="accordion-opener">
                    <div class="heading-index">
                      <span class="text text-24">06.</span>
                      <h2 class="heading text-24">Launch & Support</h2>
                    </div>
                    <div class="svg-wrapper">
                      <svg
                        class="icon icon-32"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <g clip-path="url(#clip0_9088_8345)">
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.7083 15.7044C12.5208 15.8919 12.2665 15.9972 12.0013 15.9972C11.7362 15.9972 11.4818 15.8919 11.2943 15.7044L5.63732 10.0474C5.54181 9.95517 5.46563 9.84482 5.41322 9.72282C5.36081 9.60081 5.33322 9.46959 5.33207 9.33681C5.33092 9.20404 5.35622 9.07236 5.4065 8.94946C5.45678 8.82656 5.53103 8.71491 5.62492 8.62102C5.71882 8.52713 5.83047 8.45287 5.95337 8.40259C6.07626 8.35231 6.20794 8.32701 6.34072 8.32816C6.4735 8.32932 6.60472 8.3569 6.72672 8.40931C6.84873 8.46172 6.95907 8.5379 7.05132 8.63341L12.0013 13.5834L16.9513 8.63341C17.1399 8.45125 17.3925 8.35046 17.6547 8.35274C17.9169 8.35502 18.1677 8.46019 18.3531 8.64559C18.5385 8.831 18.6437 9.08182 18.646 9.34401C18.6483 9.60621 18.5475 9.85881 18.3653 10.0474L12.7083 15.7044Z"
                            fill="CurrentColor"
                          />
                        </g>
                        <defs>
                          <clipPath>
                            <rect width="24" height="24" fill="CurrentColor" />
                          </clipPath>
                        </defs>
                      </svg>
                    </div>
                  </div>
                  <div class="accordion-content">
                    <div class="accordion-content-inner text text-16">
                      We smoothly implement your solution and monitor
                      performance closely. Beyond launch, we provide ongoing
                      support, improvements, and guidance to keep your business
                      growing and performing at its best.
                    </div>
                  </div>
                </div>
              </div>
            </faq-accordion>
          </div>
        </div>
      </div>

      <!-- Why Choose Us -->
      <div class="promotion-has-column mt-100">
        <div class="container">
          <div class="section-headings headings-width text-center">
            <div class="subheading text-20 subheading-bg" data-aos="fade-up">
              <svg
                class="icon icon-14"
                xmlns="http://www.w3.org/2000/svg"
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
              >
                <g clip-path="url(#clip0_9088_4143)">
                  <path
                    d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                    fill="CurrentColor"
                  />
                </g>
                <defs>
                  <clipPath>
                    <rect width="14" height="14" fill="CurrentColor" />
                  </clipPath>
                </defs>
              </svg>
              <span>Why Choose Us</span>
              <svg
                class="icon icon-14"
                xmlns="http://www.w3.org/2000/svg"
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
              >
                <g clip-path="url(#clip0_9088_4143)">
                  <path
                    d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                    fill="CurrentColor"
                  />
                </g>
                <defs>
                  <clipPath>
                    <rect width="14" height="14" fill="CurrentColor" />
                  </clipPath>
                </defs>
              </svg>
            </div>
            <h2 class="heading text-50" data-aos="fade-up" data-aos-delay="100">
              Supporting Growth on a Global Scale
            </h2>
          </div>
          <div class="section-content">
            <div class="row product-grid">
              <div class="col-xl-3 col-md-6 col-12">
                <div class="promotion-item" data-aos="fade-up">
                  <div class="card-icon">
                    <svg
                      viewBox="0 0 70 70"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <rect width="70" height="70" rx="10" fill="white"></rect>
                      <g clip-path="url(#clip0_9088_8914)">
                        <path
                          d="M39.4445 26.2037C39.5971 26.3562 39.797 26.4325 39.9969 26.4325C40.1969 26.4325 40.3969 26.3562 40.5494 26.2037C40.8544 25.8986 40.8544 25.4039 40.5494 25.0987L40.5388 25.0882C40.2337 24.7831 39.739 24.7831 39.4339 25.0882C39.1288 25.3933 39.1288 25.8879 39.4339 26.1931L39.4445 26.2037Z"
                          fill="#20282D"
                        ></path>
                        <path
                          d="M52.0481 33.5938L54.7712 30.8707C54.9946 30.6473 55.0614 30.3112 54.9405 30.0193C54.8195 29.7273 54.5347 29.537 54.2187 29.537H48.5741C47.8363 26.5167 46.2877 23.7646 44.0741 21.5509C40.8574 18.3341 36.5805 16.5625 32.0313 16.5625C27.482 16.5625 23.2051 18.3341 19.9884 21.5509C16.7716 24.7677 15 29.0445 15 33.5938C15 38.143 16.7716 42.4199 19.9884 45.6366C20.9449 46.5932 21.9958 47.4209 23.1191 48.1132L20.7655 52.2714C20.6286 52.5133 20.6305 52.8097 20.7705 53.0497C20.9104 53.2898 21.1673 53.4375 21.4453 53.4375H25.4688C25.7502 53.4375 26.01 53.2861 26.1487 53.0411L27.8129 50.1009C29.175 50.4464 30.5894 50.625 32.0313 50.625C33.4731 50.625 34.8875 50.4464 36.2496 50.1009L37.9138 53.0411C38.0525 53.2861 38.3123 53.4375 38.5938 53.4375H42.6172C42.8952 53.4375 43.1521 53.2898 43.2921 53.0498C43.4321 52.8097 43.434 52.5133 43.2971 52.2715L40.9434 48.1133C42.0668 47.4209 43.1177 46.5933 44.0742 45.6367C46.287 43.4239 47.8363 40.6706 48.5741 37.6505H54.2188C54.5347 37.6505 54.8196 37.4602 54.9406 37.1683C55.0615 36.8764 54.9946 36.5403 54.7713 36.3169L52.0481 33.5938ZM50.6196 32.8125H45.1673L46.8803 31.0995H52.3327L50.6196 32.8125ZM25.0132 51.875H22.7852L24.4857 48.8709C25.0693 49.1598 25.6684 49.4153 26.2814 49.6345L25.0132 51.875ZM41.2773 51.875H39.0493L37.7811 49.6345C38.3941 49.4153 38.9932 49.1598 39.5768 48.8709L41.2773 51.875ZM42.9693 44.5318C41.9373 45.5638 40.7846 46.4312 39.5438 47.1226C39.5285 47.13 39.5131 47.137 39.498 47.1455C39.4885 47.1509 39.4799 47.1571 39.4708 47.1628C38.519 47.6864 37.516 48.1068 36.4753 48.4173C36.4344 48.4254 36.3939 48.4374 36.354 48.4524C34.967 48.8538 33.5152 49.0625 32.0313 49.0625C30.5473 49.0625 29.0955 48.8538 27.7085 48.4525C27.6685 48.4375 27.628 48.4255 27.587 48.4173C26.5464 48.1069 25.5434 47.6865 24.5917 47.1629C24.5826 47.1572 24.574 47.151 24.5645 47.1456C24.5495 47.1371 24.5341 47.1301 24.5188 47.1227C23.278 46.4313 22.1253 45.5639 21.0933 44.5318C18.1716 41.6102 16.5625 37.7256 16.5625 33.5938C16.5625 29.4619 18.1716 25.5773 21.0932 22.6557C24.0148 19.7341 27.8994 18.125 32.0313 18.125C36.1631 18.125 40.0477 19.7341 42.9693 22.6557C44.8891 24.5755 46.2583 26.9404 46.9613 29.537H46.5568C46.3496 29.537 46.1509 29.6194 46.0044 29.7659L43.9309 31.8394C43.7216 30.419 43.2624 29.0379 42.569 27.7819C42.3605 27.4041 41.8852 27.2671 41.5074 27.4755C41.1297 27.6841 40.9926 28.1594 41.2011 28.5371C41.9427 29.8804 42.357 31.3409 42.4631 32.8126H39.0184C38.8445 31.2301 38.1452 29.7641 37.0031 28.622C35.6751 27.2939 33.9094 26.5625 32.0313 26.5625C30.1531 26.5625 28.3874 27.2939 27.0595 28.6219C25.7314 29.95 25 31.7156 25 33.5938C25 35.4719 25.7314 37.2376 27.0594 38.5655C28.3874 39.8936 30.1531 40.625 32.0313 40.625C33.9094 40.625 35.6751 39.8936 37.003 38.5656C38.1451 37.4236 38.8444 35.9576 39.0183 34.375H42.4596C42.2733 36.8172 41.2427 39.1872 39.4338 40.9963C37.4565 42.9736 34.8275 44.0625 32.0313 44.0625C29.235 44.0625 26.606 42.9736 24.6288 40.9963C22.6514 39.019 21.5625 36.3901 21.5625 33.5938C21.5625 30.7974 22.6514 28.1685 24.6288 26.1912C27.9086 22.9114 33.032 22.1847 37.088 24.424C37.4656 24.6324 37.9409 24.4954 38.1495 24.1177C38.358 23.7399 38.2209 23.2647 37.8432 23.0561C35.6053 21.8205 32.9702 21.3281 30.4236 21.6698C27.792 22.0228 25.406 23.2042 23.5239 25.0864C21.2515 27.3588 20 30.3801 20 33.5938C20 36.8074 21.2515 39.8288 23.5238 42.1011C25.7963 44.3735 28.8176 45.625 32.0313 45.625C35.2449 45.625 38.2663 44.3735 40.5386 42.1012C42.3851 40.2548 43.5565 37.9234 43.9336 35.351L46.0043 37.4217C46.1508 37.5682 46.3495 37.6505 46.5567 37.6505H46.9611C46.258 40.247 44.8883 42.6128 42.9693 44.5318ZM34.5828 32.1206C34.3671 31.7469 33.8893 31.6189 33.5156 31.8347L31.6406 32.9172C31.3989 33.0567 31.25 33.3146 31.25 33.5938C31.25 33.8729 31.3989 34.1308 31.6406 34.2703L33.5156 35.3528C33.6387 35.4238 33.773 35.4576 33.9055 35.4576C34.1755 35.4576 34.4381 35.3175 34.5828 35.0669C34.7096 34.8473 34.7169 34.5921 34.6262 34.375H37.4443C37.2788 35.5393 36.7446 36.6144 35.8982 37.4607C34.8653 38.4937 33.492 39.0625 32.0313 39.0625C30.5705 39.0625 29.1972 38.4937 28.1642 37.4607C27.1313 36.4278 26.5625 35.0545 26.5625 33.5938C26.5625 32.133 27.1313 30.7597 28.1643 29.7267C29.1972 28.6938 30.5705 28.125 32.0313 28.125C33.492 28.125 34.8653 28.6938 35.8983 29.7268C36.7446 30.5731 37.2788 31.6482 37.4444 32.8125H34.6263C34.7169 32.5953 34.7096 32.3402 34.5828 32.1206ZM46.8803 36.088L45.1673 34.375H50.6196L52.3327 36.088H46.8803Z"
                          fill="#20282D"
                        ></path>
                      </g>
                      <defs>
                        <clipPath id="clip0_9088_8914">
                          <rect
                            width="40"
                            height="40"
                            fill="white"
                            transform="translate(15 15)"
                          ></rect>
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <div class="promotion-title">
                    <div class="text text-24 fw-600">Our Mission</div>
                  </div>
                  <div class="promotion-text text text-18">
                    Our mission is push engage boundaries, enga audiences, and
                    driv engage.
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 col-12">
                <div
                  class="promotion-item"
                  data-aos="fade-up"
                  data-aos-delay="50"
                >
                  <div class="card-icon">
                    <svg
                      viewBox="0 0 70 70"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <rect width="70" height="70" rx="10" fill="white"></rect>
                      <g clip-path="url(#clip0_9088_8924)">
                        <path
                          d="M35 27.0312C30.606 27.0312 27.0312 30.606 27.0312 35C27.0312 39.394 30.606 42.9688 35 42.9688C39.394 42.9688 42.9688 39.394 42.9688 35C42.9688 30.606 39.394 27.0312 35 27.0312ZM35 41.4062C31.4676 41.4062 28.5938 38.5324 28.5938 35C28.5938 31.4676 31.4676 28.5938 35 28.5938C38.5324 28.5938 41.4062 31.4676 41.4062 35C41.4062 38.5324 38.5324 41.4062 35 41.4062Z"
                          fill="#1C2539"
                        ></path>
                        <path
                          d="M34.9998 34.2784C34.4895 34.2784 34.0742 33.9339 34.0742 33.5105C34.0742 33.0872 34.4895 32.7427 34.9998 32.7427C35.5102 32.7427 35.9255 33.0872 35.9255 33.5105C35.9255 33.942 36.2753 34.2918 36.7067 34.2918C37.1381 34.2918 37.488 33.942 37.488 33.5105C37.488 32.4812 36.7714 31.6062 35.7811 31.2986V31.2578C35.7811 30.8263 35.4313 30.4766 34.9998 30.4766C34.5684 30.4766 34.2186 30.8263 34.2186 31.2578V31.2986C33.2284 31.6062 32.5117 32.4812 32.5117 33.5105C32.5117 34.7955 33.6279 35.8409 34.9998 35.8409C35.5102 35.8409 35.9255 36.1853 35.9255 36.6087C35.9255 37.032 35.5103 37.3765 34.9998 37.3765C34.4894 37.3765 34.0742 37.032 34.0742 36.6087C34.0742 36.1772 33.7244 35.8274 33.293 35.8274C32.8616 35.8274 32.5117 36.1772 32.5117 36.6087C32.5117 37.6384 33.2287 38.5136 34.2195 38.8209C34.2296 39.2436 34.5748 39.5833 34.9998 39.5833C35.4249 39.5833 35.77 39.2436 35.7802 38.8209C36.7709 38.5136 37.488 37.6384 37.488 36.6087C37.488 35.3237 36.3718 34.2784 34.9998 34.2784Z"
                          fill="#1C2539"
                        ></path>
                        <path
                          d="M50.1774 21.7288L50.1619 21.7132C49.8567 21.4081 49.3622 21.4081 49.0569 21.7132C48.7519 22.0183 48.7519 22.5129 49.0569 22.8181L49.0726 22.8337C49.2251 22.9863 49.4251 23.0626 49.625 23.0626C49.8249 23.0626 50.0248 22.9863 50.1774 22.8337C50.4825 22.5287 50.4825 22.034 50.1774 21.7288Z"
                          fill="#1C2539"
                        ></path>
                        <path
                          d="M20.2593 46.4008C20.1141 46.2554 19.9125 46.1719 19.707 46.1719C19.5016 46.1719 19.3 46.2555 19.1547 46.4008C19.0094 46.5461 18.9258 46.7477 18.9258 46.9531C18.9258 47.1586 19.0093 47.3602 19.1547 47.5055C19.3001 47.6508 19.5016 47.7344 19.707 47.7344C19.9125 47.7344 20.1141 47.6508 20.2593 47.5055C20.4046 47.3602 20.4883 47.1586 20.4883 46.9531C20.4883 46.7477 20.4047 46.5461 20.2593 46.4008Z"
                          fill="#1C2539"
                        ></path>
                        <path
                          d="M54.9973 34.8982C54.9752 31.2386 53.9524 27.6184 52.0317 24.5065C51.8052 24.1393 51.3238 24.0253 50.9566 24.252C50.5894 24.4786 50.4755 24.9599 50.702 25.3271C52.0945 27.5834 52.9512 30.0347 53.2916 32.5243C52.997 32.1788 52.6552 31.7909 52.2684 31.372C50.785 29.7656 48.4005 27.4532 45.4647 25.5604C45.1936 25.3856 44.8552 25.4 44.6039 25.5696L43.1139 26.4299C41.7634 25.1499 40.1406 24.2121 38.364 23.6852V21.9129C38.364 21.4814 38.0141 21.1316 37.5827 21.1316H32.4172C31.9858 21.1316 31.6359 21.4814 31.6359 21.9129V23.6852C29.8593 24.212 28.2366 25.1498 26.886 26.4299L25.4788 25.6174C25.2237 25.3892 24.8388 25.3479 24.5366 25.5419C21.5888 27.4337 19.2089 29.7383 17.7315 31.3385C17.3441 31.7581 17.0035 32.1452 16.7109 32.4893C17.2448 28.6068 19.0252 24.8991 21.9627 21.9617C28.0354 15.889 37.3733 14.7928 44.6706 19.2961C45.0377 19.5226 45.5191 19.4087 45.7458 19.0415C45.9724 18.6743 45.8584 18.193 45.4912 17.9663C41.7249 15.6422 37.2141 14.6313 32.7907 15.1205C30.5803 15.3648 28.4446 15.9689 26.443 16.9161C24.3718 17.8962 22.4927 19.222 20.858 20.8567C17.781 23.9337 15.8268 27.8301 15.2064 32.1248C15.074 33.0413 15.007 33.9661 15.0037 34.8906C15.0001 34.927 15 34.9616 15 34.9988C15 35.0414 15.0001 35.0796 15.0047 35.1195C15.0291 38.3063 15.8087 41.4812 17.2852 44.2934C17.4249 44.5595 17.6966 44.7116 17.9776 44.7116C18.0999 44.7116 18.2241 44.6827 18.3401 44.6219C18.7221 44.4213 18.8691 43.949 18.6686 43.567C17.6452 41.618 16.998 39.5584 16.7116 37.477C17.0055 37.8216 17.3463 38.2084 17.7316 38.6257C19.215 40.2322 21.5995 42.5445 24.5353 44.4374C24.6663 44.5218 24.813 44.5621 24.9579 44.562C25.1048 44.562 25.2492 44.5194 25.3745 44.4406L26.8861 43.5678C28.2366 44.8479 29.8594 45.7856 31.636 46.3125V48.0848C31.636 48.5163 31.9859 48.866 32.4173 48.866H37.5828C38.0142 48.866 38.3641 48.5163 38.3641 48.0848V46.3125C40.1407 45.7856 41.7634 44.8479 43.114 43.5678L44.5187 44.3788C44.6638 44.5098 44.8514 44.5799 45.0422 44.5799C45.1866 44.5799 45.3328 44.5398 45.4634 44.456C48.4113 42.5642 50.7912 40.2596 52.2685 38.6593C52.6559 38.2397 52.9965 37.8526 53.2891 37.5085C52.7549 41.382 50.9807 45.0925 48.0372 48.0359C42.2243 53.8488 33.1612 55.1066 25.9976 51.0945C25.6213 50.8839 25.1452 51.018 24.9342 51.3945C24.7234 51.7709 24.8577 52.247 25.2341 52.4578C28.209 54.1239 31.6112 54.9964 35.0288 54.9964C35.892 54.9964 36.7563 54.9407 37.6149 54.8281C42.0122 54.2513 45.9983 52.2847 49.1422 49.1409C50.777 47.506 52.1028 45.6269 53.0829 43.5556C54.0301 41.5538 54.6341 39.4181 54.8784 37.2076C54.9565 36.5011 54.9959 35.7924 54.9982 35.0849C55 35.0564 55 35.0284 55 34.9988C55 34.9634 54.9999 34.931 54.9973 34.8982ZM16.7149 34.9893C17.4036 34.033 19.4798 31.4644 22.4433 29.0134L21.6993 30.302C21.5957 30.4814 21.5676 30.6946 21.6213 30.8948C21.6749 31.0949 21.8058 31.2656 21.9852 31.3692L23.5205 32.2556C23.307 33.1516 23.199 34.0716 23.199 34.9988C23.199 35.926 23.307 36.846 23.5205 37.7421L21.9852 38.6285C21.8058 38.7321 21.6748 38.9027 21.6213 39.1029C21.5676 39.3031 21.5957 39.5163 21.6993 39.6957L22.4101 40.9269C19.5066 38.5061 17.4269 35.9595 16.7149 34.9893ZM44.7553 42.7113L43.3766 41.9152C43.0644 41.7349 42.6688 41.792 42.42 42.0534C41.0534 43.4903 39.3176 44.4932 37.4003 44.9538C37.0491 45.0381 36.8016 45.3523 36.8016 45.7134V47.3035H33.1984V45.7134C33.1984 45.3523 32.9509 45.0381 32.5997 44.9538C30.6824 44.4932 28.9466 43.4904 27.58 42.0534C27.3312 41.792 26.9358 41.7348 26.6233 41.9152L25.2446 42.7113L23.443 39.5909L24.8198 38.7961C25.1323 38.6157 25.2805 38.2448 25.1786 37.8987C24.9018 36.9596 24.7615 35.984 24.7615 34.9988C24.7615 34.0137 24.9018 33.038 25.1786 32.099C25.2806 31.7529 25.1323 31.382 24.8198 31.2016L23.443 30.4067L25.2446 27.2864L26.6233 28.0824C26.9358 28.2629 27.3313 28.2058 27.58 27.9442C28.9466 26.5074 30.6824 25.5045 32.5997 25.0439C32.9509 24.9595 33.1984 24.6454 33.1984 24.2842V22.6941H36.8015V24.2842C36.8015 24.6454 37.0491 24.9595 37.4002 25.0439C39.3175 25.5045 41.0533 26.5073 42.4199 27.9442C42.6688 28.2057 43.0641 28.2629 43.3766 28.0824L44.7553 27.2864L46.5569 30.4067L45.1801 31.2016C44.8676 31.382 44.7194 31.7529 44.8213 32.099C45.0981 33.0381 45.2384 34.0137 45.2384 34.9988C45.2384 35.984 45.0981 36.9597 44.8213 37.8987C44.7193 38.2448 44.8676 38.6157 45.1801 38.7961L46.5569 39.5909L44.7553 42.7113ZM47.5565 40.9847L48.3007 39.6956C48.4043 39.5162 48.4324 39.303 48.3787 39.1028C48.3251 38.9027 48.1942 38.732 48.0148 38.6284L46.4795 37.742C46.693 36.8459 46.801 35.9259 46.801 34.9988C46.801 34.0716 46.693 33.1516 46.4795 32.2555L48.0148 31.3691C48.1942 31.2655 48.3252 31.0949 48.3787 30.8947C48.4324 30.6945 48.4043 30.4813 48.3007 30.3019L47.5899 29.0708C50.4934 31.4915 52.5731 34.0381 53.2852 35.0083C52.5964 35.9647 50.5202 38.5335 47.5565 40.9847Z"
                          fill="#1C2539"
                        ></path>
                      </g>
                      <defs>
                        <clipPath id="clip0_9088_8924">
                          <rect
                            width="40"
                            height="40"
                            fill="white"
                            transform="translate(15 15)"
                          ></rect>
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <div class="promotion-title">
                    <div class="text text-24 fw-600">Our Vision</div>
                  </div>
                  <div class="promotion-text text text-18">
                    We aim to shape a future where bold ideas and smart strategy
                    drive lasting success.
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 col-12">
                <div
                  class="promotion-item"
                  data-aos="fade-up"
                  data-aos-delay="100"
                >
                  <div class="card-icon">
                    <svg
                      viewBox="0 0 70 70"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <rect width="70" height="70" rx="10" fill="white"></rect>
                      <g clip-path="url(#clip0_9088_8945)">
                        <path
                          d="M24.8815 28.0246C24.8815 27.5897 25.2341 27.237 25.6691 27.237C26.1041 27.237 26.4567 27.5896 26.4567 28.0246C26.4567 28.4596 26.1041 28.8122 25.6691 28.8122C25.2341 28.8122 24.8815 28.4595 24.8815 28.0246ZM49.1647 38.5557L40.3842 37.7579L37.9433 44.6052H42.2836C42.7185 44.6052 43.0711 44.9578 43.0711 45.3927V47.7551H44.6461C45.0809 47.7551 45.4336 48.1078 45.4336 48.5426V53.4251H45.8273C46.2622 53.4251 46.6148 53.7777 46.6148 54.2126C46.6148 54.6474 46.2622 55.0001 45.8273 55.0001H24.565C24.1302 55.0001 23.7775 54.6474 23.7775 54.2126C23.7775 53.7777 24.1302 53.4251 24.565 53.4251H24.9588V48.5426C24.9588 48.1078 25.3114 47.7551 25.7463 47.7551H27.3212V45.3927C27.3212 44.9578 27.6739 44.6052 28.1087 44.6052H32.6204L29.6215 35.4017L20.4558 31.7982C19.9565 31.6522 19.7029 30.8291 20.3306 30.3949L22.2395 29.216C22.2403 29.216 22.2411 29.216 22.2411 29.2151C23.1182 28.6749 23.9442 30.016 23.0671 30.5562L22.4971 30.9082L30.5437 34.0717C30.7626 34.1583 30.9311 34.3362 31.0043 34.5607L34.2773 44.6052H36.2716L39.1052 36.6538C39.225 36.3183 39.5628 36.1017 39.9187 36.134L47.755 36.8459L43.3191 29.5222C43.1947 29.3167 43.1719 29.06 43.2569 28.8348L46.362 20.6574L38.2295 22.9231C37.987 22.9901 37.7169 22.9342 37.5216 22.7751L30.865 17.3602L30.3499 25.6675C30.3342 25.9226 30.1956 26.1549 29.9782 26.2889L29.0977 26.833C28.2048 27.3844 27.3772 26.044 28.2701 25.4926L28.8032 25.1635L29.3876 15.734C29.4347 15.1529 30.1435 14.7566 30.6704 15.1718L38.1996 21.2961L47.44 18.7226C48.1288 18.5747 48.6165 19.1843 48.3874 19.7612L44.8657 29.0347L49.9096 37.364C50.2779 37.8709 49.8207 38.6024 49.1647 38.5557ZM29.8412 49.3301H26.5337V53.4251H29.8412V49.3301ZM38.9761 49.3301H31.4162V53.4251H38.9761V49.3301ZM40.5511 49.3301V53.4251H43.8586V49.3301H40.5511ZM41.4961 46.1802H28.8962V47.7551H41.4961V46.1802Z"
                          fill="#1C2539"
                        ></path>
                      </g>
                      <defs>
                        <clipPath id="clip0_9088_8945">
                          <rect
                            width="40"
                            height="40"
                            fill="white"
                            transform="translate(15 15)"
                          ></rect>
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <div class="promotion-title">
                    <div class="text text-24 fw-600">Our Awards</div>
                  </div>
                  <div class="promotion-text text text-18">
                    Each award celebrates our commitment to impactful ideas,
                    quality work, and outstanding performance.
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 col-12">
                <div
                  class="promotion-item"
                  data-aos="fade-up"
                  data-aos-delay="150"
                >
                  <div class="card-icon">
                    <svg
                      class="icon-32"
                      width="40"
                      height="40"
                      viewBox="0 0 40 40"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <g clip-path="url(#clip0_9105_30181)">
                        <path
                          d="M3.09175 23.9688C3.38125 24.0267 3.72285 23.8004 3.78143 23.5099C3.79042 23.4654 4.71851 18.9998 8.11233 14.1991C10.0981 11.3901 12.5294 9.01514 15.3386 7.14012C18.7079 4.89132 22.6379 3.35744 27.0271 2.57581L26.548 3.30502C26.1455 3.91761 27.091 4.61245 27.5272 3.94839L28.7319 2.11477C28.9001 1.79747 28.8439 1.52687 28.5631 1.30292L26.7263 0.1004C26.0926 -0.314863 25.4508 0.665803 26.0845 1.08068L26.6527 1.45274C22.1593 2.27421 18.1277 3.86387 14.6601 6.18422C11.7284 8.14586 9.19338 10.6292 7.12542 13.5653C3.60466 18.5641 2.67055 23.0895 2.63251 23.2797C2.56908 23.5968 2.77468 23.9051 3.09175 23.9688Z"
                          fill="CurrentColor"
                        ></path>
                        <path
                          d="M35.5768 30.0864V26.3214C35.5768 25.9977 35.3145 25.7355 34.9909 25.7355H31.1417V7.82806C31.1417 7.50442 30.8794 7.24219 30.5558 7.24219H23.0685C22.745 7.24219 22.4827 7.50442 22.4827 7.82806V13.9723H15.5752C15.2517 13.9723 14.9893 14.2345 14.9893 14.5581V20.715H8.08187C7.75831 20.715 7.496 20.9772 7.496 21.3009V26.604H0.588448C0.264892 26.604 0.00257874 26.8662 0.00257874 27.1899V33.0497C0.00257874 33.3733 0.264892 33.6356 0.588448 33.6356H2.66578C3.42327 33.6356 3.42327 32.4638 2.66578 32.4638H1.17432V27.7757H7.48983V32.4638H5.78385C5.02637 32.4638 5.02637 33.6356 5.78385 33.6356H17.74V39.4112C17.74 39.7349 18.0023 39.9971 18.3259 39.9971H34.9909C34.9944 39.9971 34.9979 39.9966 35.0014 39.9966C35.0083 39.9966 35.0152 39.9971 35.0221 39.9971C35.8983 39.9971 36.7612 39.765 37.5175 39.326C38.1727 38.9457 37.5846 37.9327 36.9293 38.3126C36.3514 38.648 35.692 38.8253 35.0221 38.8253C32.9249 38.8253 31.2187 37.1209 31.2187 35.0258C31.2187 32.9307 32.9249 31.2264 35.0221 31.2264C37.1194 31.2264 38.8256 32.9307 38.8256 35.0258C38.8256 35.4766 38.7474 35.9177 38.5931 36.3369C38.3314 37.0478 39.431 37.4525 39.6927 36.7417C39.8948 36.1925 39.9973 35.6152 39.9973 35.0258C39.9973 32.4722 38.0599 30.363 35.5768 30.0864ZM32.1489 30.9714H27.2443V29.5252H34.405V30.0944C33.5718 30.1979 32.8024 30.5077 32.1489 30.9714ZM26.0725 32.1432V33.5894H18.9118V32.1432H26.0725ZM18.9118 34.7611H26.0725V36.2074H18.9118V34.7611ZM27.2443 34.7611H30.0542C30.0289 35.2406 30.0762 35.7421 30.1901 36.2074H27.2443V34.7611ZM30.2596 33.5893H27.2443V32.1431H30.9728C30.6614 32.5786 30.4182 33.0656 30.2596 33.5893ZM34.405 28.3535H27.2443V26.9072H30.4803C30.5051 26.9104 30.5302 26.9126 30.5559 26.9126C30.5816 26.9126 30.6066 26.9104 30.6315 26.9072H34.4051V28.3535H34.405ZM29.9699 8.41393V25.7355H26.6584C26.3348 25.7355 26.0725 25.9977 26.0725 26.3214V28.9393V30.9714H23.6544V8.41393H29.9699ZM14.9832 32.4638H8.66774V21.8868H14.9832V32.4638ZM16.1611 32.4638V15.144H22.4766V30.9714H18.3259C18.0023 30.9714 17.74 31.2336 17.74 31.5572V32.4638L16.1611 32.4638ZM26.0725 38.8254H18.9118V37.3791H26.0725V38.8254ZM27.2443 38.8254V37.3791H30.6409C30.9399 37.9326 31.3412 38.4227 31.8187 38.8254H27.2443Z"
                          fill="CurrentColor"
                        ></path>
                        <path
                          d="M34.9994 38.1165C35.323 38.1165 35.5853 37.8543 35.5853 37.5307V37.3316C36.0858 37.1309 36.4641 36.6834 36.558 36.1243C36.6788 35.4046 36.2892 34.7549 35.5884 34.5076C35.2944 34.4038 34.842 34.3332 34.7475 34.1256C34.7005 34.0223 34.7709 33.9302 34.8721 33.8754C35.1535 33.7906 35.3323 33.9262 35.3517 33.9421C35.3434 33.9354 35.3394 33.9312 35.3394 33.9312C35.3394 33.9312 35.8569 34.2362 36.1505 33.9426C36.6973 33.3958 36.133 33.0691 36.133 33.0691C36.0213 32.9662 35.8307 32.8438 35.5853 32.7632V32.6306C35.5853 31.8731 34.4135 31.8731 34.4135 32.6306V32.7971C33.9923 32.9702 33.6833 33.3518 33.595 33.8212C33.5049 34.2998 33.6658 34.7669 34.015 35.0403C34.3307 35.2876 34.7703 35.4615 35.1985 35.6125C35.3027 35.6493 35.4373 35.7222 35.4024 35.9302C35.3811 36.0573 35.2713 36.2729 34.9956 36.2747C34.6716 36.2768 34.6026 36.2662 34.3712 36.1151C34.1003 35.9382 33.7373 36.0144 33.5604 36.2853C33.3834 36.5563 33.4596 36.9193 33.7305 37.0962C33.9871 37.2638 34.1945 37.354 34.4135 37.4007V37.5306C34.4135 37.8543 34.6759 38.1165 34.9994 38.1165Z"
                          fill="CurrentColor"
                        ></path>
                      </g>
                      <defs>
                        <clipPath id="clip0_9105_30181">
                          <rect
                            width="40"
                            height="40"
                            fill="CurrentColor"
                          ></rect>
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <div class="promotion-title">
                    <div class="text text-24 fw-600">Our ambition</div>
                  </div>
                  <div class="promotion-text text text-18">
                    Our ambition is to set new standards, inspire innovation,
                    and help brands achieve meaningful success.
                  </div>
                </div>
              </div>
            </div>

            <div class="promotion-media-wrap">
              <div class="media media-bg overlay">
                <img
                  src="{{ asset('front-assets/consulo') }}/img/why-choose-us/1.jpg"
                  width="1000"
                  height="742"
                  loading="lazy"
                  alt="banner image"
                />
              </div>
              <div class="promotion-counter">
                <counter-up class="counter-up-wrap">
                  <div class="counter-up">
                    <div class="counter-item" data-aos="fade-right">
                      <h2 class="heading text-64" data-target="20">
                        0 <span>k+</span>
                      </h2>
                      <div class="text text-24 fw-500">Project completed</div>
                    </div>
                    <div class="counter-item" data-aos="fade-up">
                      <h2 class="heading text-64" data-target="12">
                        0<span>k+</span>
                      </h2>
                      <div class="text text-24 fw-500">Happy customers</div>
                    </div>
                    <div class="counter-item" data-aos="fade-left">
                      <h2 class="heading text-64" data-target="25">
                        0<span>+</span>
                      </h2>
                      <div class="text text-24 fw-500">Years experiences</div>
                    </div>
                  </div>
                </counter-up>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Our Team -->
      <team-slider class="team-slider mt-100">
        <div class="container">
          <div class="section-headings headings-width text-center">
            <div class="subheading text-20 subheading-bg" data-aos="fade-up">
              <svg
                class="icon icon-14"
                xmlns="http://www.w3.org/2000/svg"
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
              >
                <g clip-path="url(#clip0_9088_4143)">
                  <path
                    d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                    fill="CurrentColor"
                  />
                </g>
                <defs>
                  <clipPath>
                    <rect width="14" height="14" fill="CurrentColor" />
                  </clipPath>
                </defs>
              </svg>
              <span>Our Team</span>
              <svg
                class="icon icon-14"
                xmlns="http://www.w3.org/2000/svg"
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
              >
                <g clip-path="url(#clip0_9088_4143)">
                  <path
                    d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                    fill="CurrentColor"
                  />
                </g>
                <defs>
                  <clipPath>
                    <rect width="14" height="14" fill="CurrentColor" />
                  </clipPath>
                </defs>
              </svg>
            </div>
            <h2 class="heading text-50" data-aos="fade-up">
              Meet the experts behind your success
            </h2>
          </div>
        </div>

        <div class="section-content" data-aos="fade-up">
          <div class="container">
            <div class="swiper">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="card-team radius18">
                    <img
                      src="{{ asset('front-assets/consulo') }}/img/team/1.jpg"
                      alt="team image"
                      width="500"
                      height="619"
                      loading="lazy"
                    />
                    <div class="card-team-content-absolute">
                      <div class="card-team-content">
                        <a
                          href="{{ route('front.success-stories.index') }}"
                          aria-label="team details"
                          class="heading text-22 fw-600"
                          >Ronald Richards</a
                        >
                        <p class="text text-18">Finance Advisor</p>
                      </div>
                    </div>
                    <div class="social-list">
                      <a href="#" class="svg-wrapper" aria-label="LinkedIn">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="17"
                          height="16"
                          viewBox="0 0 17 16"
                          fill="none"
                        >
                          <path
                            d="M3.78357 2.16742C3.78326 2.84601 3.37157 3.45666 2.74262 3.71142C2.11367 3.96619 1.39306 3.81419 0.920587 3.32711C0.448112 2.84001 0.318129 2.11511 0.59192 1.49421C0.86572 0.873305 1.48862 0.480397 2.1669 0.500755C3.0678 0.527797 3.78398 1.26612 3.78357 2.16742ZM3.83357 5.06742H0.500237V15.5007H3.83357V5.06742ZM9.10025 5.06742H5.78357V15.5007H9.06692V10.0257C9.06692 6.97573 13.0419 6.6924 13.0419 10.0257V15.5007H16.3336V8.8924C16.3336 3.75075 10.4503 3.94242 9.06692 6.4674L9.10025 5.06742Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="twitter">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="14"
                          viewBox="0 0 18 14"
                          fill="none"
                        >
                          <path
                            d="M17.5104 1.71289C16.8743 1.9943 16.1996 2.17914 15.5088 2.26127C16.2366 1.82561 16.7812 1.14026 17.0411 0.332886C16.3573 0.739186 15.6088 1.02515 14.8282 1.17835C14.1693 0.475394 13.2483 0.0770356 12.2848 0.0781272C10.3605 0.0781272 8.79975 1.63835 8.79975 3.56354C8.79975 3.83666 8.83109 4.10153 8.88967 4.35709C5.99206 4.21121 3.42506 2.82455 1.70565 0.715686C1.39608 1.24757 1.23338 1.85216 1.2342 2.46757C1.2342 3.67667 1.84967 4.74388 2.78458 5.36868C2.23115 5.35118 1.6899 5.20171 1.20599 4.93262C1.20545 4.94726 1.20545 4.9619 1.20545 4.97574C1.20545 6.66484 2.40683 8.07384 4.00166 8.39376C3.70234 8.47476 3.3936 8.51568 3.08352 8.51543C2.85831 8.51543 2.63976 8.49468 2.42733 8.45393C2.8711 9.83826 4.15739 10.8461 5.683 10.8738C4.44845 11.8427 2.92391 12.3683 1.35453 12.3661C1.07677 12.3663 0.799246 12.3499 0.523438 12.3171C2.1167 13.3413 3.97127 13.8849 5.86535 13.8829C12.2763 13.8829 15.7817 8.57243 15.7817 3.9671C15.7817 3.81643 15.778 3.66523 15.7713 3.51615C16.4536 3.02322 17.0425 2.41257 17.5104 1.71289Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="instagram">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="18"
                          viewBox="0 0 18 18"
                          fill="none"
                        >
                          <path
                            d="M9.85724 0.671875C10.7951 0.673425 11.2703 0.678392 11.681 0.690617L11.8427 0.6959C12.0296 0.702542 12.2139 0.710875 12.4362 0.721292C13.3229 0.762267 13.9278 0.902542 14.4591 1.10879C15.0083 1.3206 15.4722 1.60671 15.9354 2.06991C16.3979 2.5331 16.6841 2.99837 16.8966 3.54629C17.1021 4.07685 17.2424 4.68241 17.2841 5.56921C17.294 5.79143 17.302 5.97577 17.3086 6.16263L17.3138 6.32437C17.326 6.73499 17.3316 7.21032 17.3333 8.14818L17.334 8.76952C17.3341 8.84543 17.3341 8.92377 17.3341 9.0046L17.334 9.23968L17.3335 9.8611C17.3319 10.7989 17.327 11.2743 17.3147 11.6848L17.3094 11.8466C17.3028 12.0335 17.2945 12.2178 17.2841 12.44C17.2431 13.3268 17.1021 13.9317 16.8966 14.4629C16.6847 15.0123 16.3979 15.4762 15.9354 15.9393C15.4722 16.4018 15.0062 16.6879 14.4591 16.9004C13.9278 17.106 13.3229 17.2463 12.4362 17.2879C12.2139 17.2978 12.0296 17.3059 11.8427 17.3124L11.681 17.3177C11.2703 17.3299 10.7951 17.3354 9.85724 17.3373L9.23582 17.3379C9.1599 17.3379 9.08157 17.3379 9.00074 17.3379H8.76565L8.14424 17.3373C7.2064 17.3358 6.73109 17.3309 6.32046 17.3186L6.15873 17.3134C5.97185 17.3067 5.78752 17.2983 5.5653 17.2879C4.67849 17.247 4.07433 17.106 3.54239 16.9004C2.99377 16.6887 2.52919 16.4018 2.06599 15.9393C1.6028 15.4762 1.31739 15.0102 1.10489 14.4629C0.898636 13.9317 0.759052 13.3268 0.717386 12.44C0.707486 12.2178 0.69941 12.0335 0.692869 11.8466L0.687627 11.6848C0.675435 11.2743 0.669877 10.7989 0.668077 9.8611L0.667969 8.14818C0.669519 7.21032 0.674477 6.73499 0.686702 6.32437L0.691994 6.16263C0.698635 5.97577 0.706969 5.79143 0.717386 5.56921C0.758352 4.68171 0.898636 4.07754 1.10489 3.54629C1.31669 2.99768 1.6028 2.5331 2.06599 2.06991C2.52919 1.60671 2.99447 1.32129 3.54239 1.10879C4.07364 0.902542 4.6778 0.762958 5.5653 0.721292C5.78752 0.7114 5.97185 0.703325 6.15873 0.696783L6.32046 0.691542C6.73109 0.679342 7.2064 0.673783 8.14424 0.671983L9.85724 0.671875ZM9.00074 4.83796C6.6983 4.83796 4.83405 6.70423 4.83405 9.0046C4.83405 11.307 6.70033 13.1713 9.00074 13.1713C11.3032 13.1713 13.1674 11.305 13.1674 9.0046C13.1674 6.70221 11.3011 4.83796 9.00074 4.83796ZM9.00074 6.50462C10.3815 6.50462 11.5007 7.62352 11.5007 9.0046C11.5007 10.3853 10.3818 11.5046 9.00074 11.5046C7.61999 11.5046 6.50072 10.3858 6.50072 9.0046C6.50072 7.62385 7.61957 6.50462 9.00074 6.50462ZM13.3757 3.58796C12.8013 3.58796 12.3341 4.05455 12.3341 4.62892C12.3341 5.20329 12.8007 5.6706 13.3757 5.6706C13.9501 5.6706 14.4174 5.20402 14.4174 4.62892C14.4174 4.05455 13.9493 3.58724 13.3757 3.58796Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="card-team radius18">
                    <img
                      src="{{ asset('front-assets/consulo') }}/img/team/2.jpg"
                      alt="team image"
                      width="500"
                      height="619"
                      loading="lazy"
                    />
                    <div class="card-team-content-absolute">
                      <div class="card-team-content">
                        <a
                          href="{{ route('front.success-stories.index') }}"
                          aria-label="team details"
                          class="heading text-22 fw-600"
                          >Ronald Richards</a
                        >
                        <p class="text text-18">Finance Advisor</p>
                      </div>
                    </div>
                    <div class="social-list">
                      <a href="#" class="svg-wrapper" aria-label="LinkedIn">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="17"
                          height="16"
                          viewBox="0 0 17 16"
                          fill="none"
                        >
                          <path
                            d="M3.78357 2.16742C3.78326 2.84601 3.37157 3.45666 2.74262 3.71142C2.11367 3.96619 1.39306 3.81419 0.920587 3.32711C0.448112 2.84001 0.318129 2.11511 0.59192 1.49421C0.86572 0.873305 1.48862 0.480397 2.1669 0.500755C3.0678 0.527797 3.78398 1.26612 3.78357 2.16742ZM3.83357 5.06742H0.500237V15.5007H3.83357V5.06742ZM9.10025 5.06742H5.78357V15.5007H9.06692V10.0257C9.06692 6.97573 13.0419 6.6924 13.0419 10.0257V15.5007H16.3336V8.8924C16.3336 3.75075 10.4503 3.94242 9.06692 6.4674L9.10025 5.06742Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="twitter">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="14"
                          viewBox="0 0 18 14"
                          fill="none"
                        >
                          <path
                            d="M17.5104 1.71289C16.8743 1.9943 16.1996 2.17914 15.5088 2.26127C16.2366 1.82561 16.7812 1.14026 17.0411 0.332886C16.3573 0.739186 15.6088 1.02515 14.8282 1.17835C14.1693 0.475394 13.2483 0.0770356 12.2848 0.0781272C10.3605 0.0781272 8.79975 1.63835 8.79975 3.56354C8.79975 3.83666 8.83109 4.10153 8.88967 4.35709C5.99206 4.21121 3.42506 2.82455 1.70565 0.715686C1.39608 1.24757 1.23338 1.85216 1.2342 2.46757C1.2342 3.67667 1.84967 4.74388 2.78458 5.36868C2.23115 5.35118 1.6899 5.20171 1.20599 4.93262C1.20545 4.94726 1.20545 4.9619 1.20545 4.97574C1.20545 6.66484 2.40683 8.07384 4.00166 8.39376C3.70234 8.47476 3.3936 8.51568 3.08352 8.51543C2.85831 8.51543 2.63976 8.49468 2.42733 8.45393C2.8711 9.83826 4.15739 10.8461 5.683 10.8738C4.44845 11.8427 2.92391 12.3683 1.35453 12.3661C1.07677 12.3663 0.799246 12.3499 0.523438 12.3171C2.1167 13.3413 3.97127 13.8849 5.86535 13.8829C12.2763 13.8829 15.7817 8.57243 15.7817 3.9671C15.7817 3.81643 15.778 3.66523 15.7713 3.51615C16.4536 3.02322 17.0425 2.41257 17.5104 1.71289Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="instagram">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="18"
                          viewBox="0 0 18 18"
                          fill="none"
                        >
                          <path
                            d="M9.85724 0.671875C10.7951 0.673425 11.2703 0.678392 11.681 0.690617L11.8427 0.6959C12.0296 0.702542 12.2139 0.710875 12.4362 0.721292C13.3229 0.762267 13.9278 0.902542 14.4591 1.10879C15.0083 1.3206 15.4722 1.60671 15.9354 2.06991C16.3979 2.5331 16.6841 2.99837 16.8966 3.54629C17.1021 4.07685 17.2424 4.68241 17.2841 5.56921C17.294 5.79143 17.302 5.97577 17.3086 6.16263L17.3138 6.32437C17.326 6.73499 17.3316 7.21032 17.3333 8.14818L17.334 8.76952C17.3341 8.84543 17.3341 8.92377 17.3341 9.0046L17.334 9.23968L17.3335 9.8611C17.3319 10.7989 17.327 11.2743 17.3147 11.6848L17.3094 11.8466C17.3028 12.0335 17.2945 12.2178 17.2841 12.44C17.2431 13.3268 17.1021 13.9317 16.8966 14.4629C16.6847 15.0123 16.3979 15.4762 15.9354 15.9393C15.4722 16.4018 15.0062 16.6879 14.4591 16.9004C13.9278 17.106 13.3229 17.2463 12.4362 17.2879C12.2139 17.2978 12.0296 17.3059 11.8427 17.3124L11.681 17.3177C11.2703 17.3299 10.7951 17.3354 9.85724 17.3373L9.23582 17.3379C9.1599 17.3379 9.08157 17.3379 9.00074 17.3379H8.76565L8.14424 17.3373C7.2064 17.3358 6.73109 17.3309 6.32046 17.3186L6.15873 17.3134C5.97185 17.3067 5.78752 17.2983 5.5653 17.2879C4.67849 17.247 4.07433 17.106 3.54239 16.9004C2.99377 16.6887 2.52919 16.4018 2.06599 15.9393C1.6028 15.4762 1.31739 15.0102 1.10489 14.4629C0.898636 13.9317 0.759052 13.3268 0.717386 12.44C0.707486 12.2178 0.69941 12.0335 0.692869 11.8466L0.687627 11.6848C0.675435 11.2743 0.669877 10.7989 0.668077 9.8611L0.667969 8.14818C0.669519 7.21032 0.674477 6.73499 0.686702 6.32437L0.691994 6.16263C0.698635 5.97577 0.706969 5.79143 0.717386 5.56921C0.758352 4.68171 0.898636 4.07754 1.10489 3.54629C1.31669 2.99768 1.6028 2.5331 2.06599 2.06991C2.52919 1.60671 2.99447 1.32129 3.54239 1.10879C4.07364 0.902542 4.6778 0.762958 5.5653 0.721292C5.78752 0.7114 5.97185 0.703325 6.15873 0.696783L6.32046 0.691542C6.73109 0.679342 7.2064 0.673783 8.14424 0.671983L9.85724 0.671875ZM9.00074 4.83796C6.6983 4.83796 4.83405 6.70423 4.83405 9.0046C4.83405 11.307 6.70033 13.1713 9.00074 13.1713C11.3032 13.1713 13.1674 11.305 13.1674 9.0046C13.1674 6.70221 11.3011 4.83796 9.00074 4.83796ZM9.00074 6.50462C10.3815 6.50462 11.5007 7.62352 11.5007 9.0046C11.5007 10.3853 10.3818 11.5046 9.00074 11.5046C7.61999 11.5046 6.50072 10.3858 6.50072 9.0046C6.50072 7.62385 7.61957 6.50462 9.00074 6.50462ZM13.3757 3.58796C12.8013 3.58796 12.3341 4.05455 12.3341 4.62892C12.3341 5.20329 12.8007 5.6706 13.3757 5.6706C13.9501 5.6706 14.4174 5.20402 14.4174 4.62892C14.4174 4.05455 13.9493 3.58724 13.3757 3.58796Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="card-team radius18">
                    <img
                      src="{{ asset('front-assets/consulo') }}/img/team/3.jpg"
                      alt="team image"
                      width="500"
                      height="619"
                      loading="lazy"
                    />
                    <div class="card-team-content-absolute">
                      <div class="card-team-content">
                        <a
                          href="{{ route('front.success-stories.index') }}"
                          aria-label="team details"
                          class="heading text-22 fw-600"
                          >Ronald Richards</a
                        >
                        <p class="text text-18">Finance Advisor</p>
                      </div>
                    </div>
                    <div class="social-list">
                      <a href="#" class="svg-wrapper" aria-label="LinkedIn">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="17"
                          height="16"
                          viewBox="0 0 17 16"
                          fill="none"
                        >
                          <path
                            d="M3.78357 2.16742C3.78326 2.84601 3.37157 3.45666 2.74262 3.71142C2.11367 3.96619 1.39306 3.81419 0.920587 3.32711C0.448112 2.84001 0.318129 2.11511 0.59192 1.49421C0.86572 0.873305 1.48862 0.480397 2.1669 0.500755C3.0678 0.527797 3.78398 1.26612 3.78357 2.16742ZM3.83357 5.06742H0.500237V15.5007H3.83357V5.06742ZM9.10025 5.06742H5.78357V15.5007H9.06692V10.0257C9.06692 6.97573 13.0419 6.6924 13.0419 10.0257V15.5007H16.3336V8.8924C16.3336 3.75075 10.4503 3.94242 9.06692 6.4674L9.10025 5.06742Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="twitter">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="14"
                          viewBox="0 0 18 14"
                          fill="none"
                        >
                          <path
                            d="M17.5104 1.71289C16.8743 1.9943 16.1996 2.17914 15.5088 2.26127C16.2366 1.82561 16.7812 1.14026 17.0411 0.332886C16.3573 0.739186 15.6088 1.02515 14.8282 1.17835C14.1693 0.475394 13.2483 0.0770356 12.2848 0.0781272C10.3605 0.0781272 8.79975 1.63835 8.79975 3.56354C8.79975 3.83666 8.83109 4.10153 8.88967 4.35709C5.99206 4.21121 3.42506 2.82455 1.70565 0.715686C1.39608 1.24757 1.23338 1.85216 1.2342 2.46757C1.2342 3.67667 1.84967 4.74388 2.78458 5.36868C2.23115 5.35118 1.6899 5.20171 1.20599 4.93262C1.20545 4.94726 1.20545 4.9619 1.20545 4.97574C1.20545 6.66484 2.40683 8.07384 4.00166 8.39376C3.70234 8.47476 3.3936 8.51568 3.08352 8.51543C2.85831 8.51543 2.63976 8.49468 2.42733 8.45393C2.8711 9.83826 4.15739 10.8461 5.683 10.8738C4.44845 11.8427 2.92391 12.3683 1.35453 12.3661C1.07677 12.3663 0.799246 12.3499 0.523438 12.3171C2.1167 13.3413 3.97127 13.8849 5.86535 13.8829C12.2763 13.8829 15.7817 8.57243 15.7817 3.9671C15.7817 3.81643 15.778 3.66523 15.7713 3.51615C16.4536 3.02322 17.0425 2.41257 17.5104 1.71289Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="instagram">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="18"
                          viewBox="0 0 18 18"
                          fill="none"
                        >
                          <path
                            d="M9.85724 0.671875C10.7951 0.673425 11.2703 0.678392 11.681 0.690617L11.8427 0.6959C12.0296 0.702542 12.2139 0.710875 12.4362 0.721292C13.3229 0.762267 13.9278 0.902542 14.4591 1.10879C15.0083 1.3206 15.4722 1.60671 15.9354 2.06991C16.3979 2.5331 16.6841 2.99837 16.8966 3.54629C17.1021 4.07685 17.2424 4.68241 17.2841 5.56921C17.294 5.79143 17.302 5.97577 17.3086 6.16263L17.3138 6.32437C17.326 6.73499 17.3316 7.21032 17.3333 8.14818L17.334 8.76952C17.3341 8.84543 17.3341 8.92377 17.3341 9.0046L17.334 9.23968L17.3335 9.8611C17.3319 10.7989 17.327 11.2743 17.3147 11.6848L17.3094 11.8466C17.3028 12.0335 17.2945 12.2178 17.2841 12.44C17.2431 13.3268 17.1021 13.9317 16.8966 14.4629C16.6847 15.0123 16.3979 15.4762 15.9354 15.9393C15.4722 16.4018 15.0062 16.6879 14.4591 16.9004C13.9278 17.106 13.3229 17.2463 12.4362 17.2879C12.2139 17.2978 12.0296 17.3059 11.8427 17.3124L11.681 17.3177C11.2703 17.3299 10.7951 17.3354 9.85724 17.3373L9.23582 17.3379C9.1599 17.3379 9.08157 17.3379 9.00074 17.3379H8.76565L8.14424 17.3373C7.2064 17.3358 6.73109 17.3309 6.32046 17.3186L6.15873 17.3134C5.97185 17.3067 5.78752 17.2983 5.5653 17.2879C4.67849 17.247 4.07433 17.106 3.54239 16.9004C2.99377 16.6887 2.52919 16.4018 2.06599 15.9393C1.6028 15.4762 1.31739 15.0102 1.10489 14.4629C0.898636 13.9317 0.759052 13.3268 0.717386 12.44C0.707486 12.2178 0.69941 12.0335 0.692869 11.8466L0.687627 11.6848C0.675435 11.2743 0.669877 10.7989 0.668077 9.8611L0.667969 8.14818C0.669519 7.21032 0.674477 6.73499 0.686702 6.32437L0.691994 6.16263C0.698635 5.97577 0.706969 5.79143 0.717386 5.56921C0.758352 4.68171 0.898636 4.07754 1.10489 3.54629C1.31669 2.99768 1.6028 2.5331 2.06599 2.06991C2.52919 1.60671 2.99447 1.32129 3.54239 1.10879C4.07364 0.902542 4.6778 0.762958 5.5653 0.721292C5.78752 0.7114 5.97185 0.703325 6.15873 0.696783L6.32046 0.691542C6.73109 0.679342 7.2064 0.673783 8.14424 0.671983L9.85724 0.671875ZM9.00074 4.83796C6.6983 4.83796 4.83405 6.70423 4.83405 9.0046C4.83405 11.307 6.70033 13.1713 9.00074 13.1713C11.3032 13.1713 13.1674 11.305 13.1674 9.0046C13.1674 6.70221 11.3011 4.83796 9.00074 4.83796ZM9.00074 6.50462C10.3815 6.50462 11.5007 7.62352 11.5007 9.0046C11.5007 10.3853 10.3818 11.5046 9.00074 11.5046C7.61999 11.5046 6.50072 10.3858 6.50072 9.0046C6.50072 7.62385 7.61957 6.50462 9.00074 6.50462ZM13.3757 3.58796C12.8013 3.58796 12.3341 4.05455 12.3341 4.62892C12.3341 5.20329 12.8007 5.6706 13.3757 5.6706C13.9501 5.6706 14.4174 5.20402 14.4174 4.62892C14.4174 4.05455 13.9493 3.58724 13.3757 3.58796Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="card-team radius18">
                    <img
                      src="{{ asset('front-assets/consulo') }}/img/team/4.jpg"
                      alt="team image"
                      width="500"
                      height="619"
                      loading="lazy"
                    />
                    <div class="card-team-content-absolute">
                      <div class="card-team-content">
                        <a
                          href="{{ route('front.success-stories.index') }}"
                          aria-label="team details"
                          class="heading text-22 fw-600"
                          >Ronald Richards</a
                        >
                        <p class="text text-18">Finance Advisor</p>
                      </div>
                    </div>
                    <div class="social-list">
                      <a href="#" class="svg-wrapper" aria-label="LinkedIn">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="17"
                          height="16"
                          viewBox="0 0 17 16"
                          fill="none"
                        >
                          <path
                            d="M3.78357 2.16742C3.78326 2.84601 3.37157 3.45666 2.74262 3.71142C2.11367 3.96619 1.39306 3.81419 0.920587 3.32711C0.448112 2.84001 0.318129 2.11511 0.59192 1.49421C0.86572 0.873305 1.48862 0.480397 2.1669 0.500755C3.0678 0.527797 3.78398 1.26612 3.78357 2.16742ZM3.83357 5.06742H0.500237V15.5007H3.83357V5.06742ZM9.10025 5.06742H5.78357V15.5007H9.06692V10.0257C9.06692 6.97573 13.0419 6.6924 13.0419 10.0257V15.5007H16.3336V8.8924C16.3336 3.75075 10.4503 3.94242 9.06692 6.4674L9.10025 5.06742Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="twitter">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="14"
                          viewBox="0 0 18 14"
                          fill="none"
                        >
                          <path
                            d="M17.5104 1.71289C16.8743 1.9943 16.1996 2.17914 15.5088 2.26127C16.2366 1.82561 16.7812 1.14026 17.0411 0.332886C16.3573 0.739186 15.6088 1.02515 14.8282 1.17835C14.1693 0.475394 13.2483 0.0770356 12.2848 0.0781272C10.3605 0.0781272 8.79975 1.63835 8.79975 3.56354C8.79975 3.83666 8.83109 4.10153 8.88967 4.35709C5.99206 4.21121 3.42506 2.82455 1.70565 0.715686C1.39608 1.24757 1.23338 1.85216 1.2342 2.46757C1.2342 3.67667 1.84967 4.74388 2.78458 5.36868C2.23115 5.35118 1.6899 5.20171 1.20599 4.93262C1.20545 4.94726 1.20545 4.9619 1.20545 4.97574C1.20545 6.66484 2.40683 8.07384 4.00166 8.39376C3.70234 8.47476 3.3936 8.51568 3.08352 8.51543C2.85831 8.51543 2.63976 8.49468 2.42733 8.45393C2.8711 9.83826 4.15739 10.8461 5.683 10.8738C4.44845 11.8427 2.92391 12.3683 1.35453 12.3661C1.07677 12.3663 0.799246 12.3499 0.523438 12.3171C2.1167 13.3413 3.97127 13.8849 5.86535 13.8829C12.2763 13.8829 15.7817 8.57243 15.7817 3.9671C15.7817 3.81643 15.778 3.66523 15.7713 3.51615C16.4536 3.02322 17.0425 2.41257 17.5104 1.71289Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="instagram">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="18"
                          viewBox="0 0 18 18"
                          fill="none"
                        >
                          <path
                            d="M9.85724 0.671875C10.7951 0.673425 11.2703 0.678392 11.681 0.690617L11.8427 0.6959C12.0296 0.702542 12.2139 0.710875 12.4362 0.721292C13.3229 0.762267 13.9278 0.902542 14.4591 1.10879C15.0083 1.3206 15.4722 1.60671 15.9354 2.06991C16.3979 2.5331 16.6841 2.99837 16.8966 3.54629C17.1021 4.07685 17.2424 4.68241 17.2841 5.56921C17.294 5.79143 17.302 5.97577 17.3086 6.16263L17.3138 6.32437C17.326 6.73499 17.3316 7.21032 17.3333 8.14818L17.334 8.76952C17.3341 8.84543 17.3341 8.92377 17.3341 9.0046L17.334 9.23968L17.3335 9.8611C17.3319 10.7989 17.327 11.2743 17.3147 11.6848L17.3094 11.8466C17.3028 12.0335 17.2945 12.2178 17.2841 12.44C17.2431 13.3268 17.1021 13.9317 16.8966 14.4629C16.6847 15.0123 16.3979 15.4762 15.9354 15.9393C15.4722 16.4018 15.0062 16.6879 14.4591 16.9004C13.9278 17.106 13.3229 17.2463 12.4362 17.2879C12.2139 17.2978 12.0296 17.3059 11.8427 17.3124L11.681 17.3177C11.2703 17.3299 10.7951 17.3354 9.85724 17.3373L9.23582 17.3379C9.1599 17.3379 9.08157 17.3379 9.00074 17.3379H8.76565L8.14424 17.3373C7.2064 17.3358 6.73109 17.3309 6.32046 17.3186L6.15873 17.3134C5.97185 17.3067 5.78752 17.2983 5.5653 17.2879C4.67849 17.247 4.07433 17.106 3.54239 16.9004C2.99377 16.6887 2.52919 16.4018 2.06599 15.9393C1.6028 15.4762 1.31739 15.0102 1.10489 14.4629C0.898636 13.9317 0.759052 13.3268 0.717386 12.44C0.707486 12.2178 0.69941 12.0335 0.692869 11.8466L0.687627 11.6848C0.675435 11.2743 0.669877 10.7989 0.668077 9.8611L0.667969 8.14818C0.669519 7.21032 0.674477 6.73499 0.686702 6.32437L0.691994 6.16263C0.698635 5.97577 0.706969 5.79143 0.717386 5.56921C0.758352 4.68171 0.898636 4.07754 1.10489 3.54629C1.31669 2.99768 1.6028 2.5331 2.06599 2.06991C2.52919 1.60671 2.99447 1.32129 3.54239 1.10879C4.07364 0.902542 4.6778 0.762958 5.5653 0.721292C5.78752 0.7114 5.97185 0.703325 6.15873 0.696783L6.32046 0.691542C6.73109 0.679342 7.2064 0.673783 8.14424 0.671983L9.85724 0.671875ZM9.00074 4.83796C6.6983 4.83796 4.83405 6.70423 4.83405 9.0046C4.83405 11.307 6.70033 13.1713 9.00074 13.1713C11.3032 13.1713 13.1674 11.305 13.1674 9.0046C13.1674 6.70221 11.3011 4.83796 9.00074 4.83796ZM9.00074 6.50462C10.3815 6.50462 11.5007 7.62352 11.5007 9.0046C11.5007 10.3853 10.3818 11.5046 9.00074 11.5046C7.61999 11.5046 6.50072 10.3858 6.50072 9.0046C6.50072 7.62385 7.61957 6.50462 9.00074 6.50462ZM13.3757 3.58796C12.8013 3.58796 12.3341 4.05455 12.3341 4.62892C12.3341 5.20329 12.8007 5.6706 13.3757 5.6706C13.9501 5.6706 14.4174 5.20402 14.4174 4.62892C14.4174 4.05455 13.9493 3.58724 13.3757 3.58796Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="card-team radius18">
                    <img
                      src="{{ asset('front-assets/consulo') }}/img/team/5.jpg"
                      alt="team image"
                      width="500"
                      height="619"
                      loading="lazy"
                    />
                    <div class="card-team-content-absolute">
                      <div class="card-team-content">
                        <a
                          href="{{ route('front.success-stories.index') }}"
                          aria-label="team details"
                          class="heading text-22 fw-600"
                          >Ronald Richards</a
                        >
                        <p class="text text-18">Finance Advisor</p>
                      </div>
                    </div>
                    <div class="social-list">
                      <a href="#" class="svg-wrapper" aria-label="LinkedIn">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="17"
                          height="16"
                          viewBox="0 0 17 16"
                          fill="none"
                        >
                          <path
                            d="M3.78357 2.16742C3.78326 2.84601 3.37157 3.45666 2.74262 3.71142C2.11367 3.96619 1.39306 3.81419 0.920587 3.32711C0.448112 2.84001 0.318129 2.11511 0.59192 1.49421C0.86572 0.873305 1.48862 0.480397 2.1669 0.500755C3.0678 0.527797 3.78398 1.26612 3.78357 2.16742ZM3.83357 5.06742H0.500237V15.5007H3.83357V5.06742ZM9.10025 5.06742H5.78357V15.5007H9.06692V10.0257C9.06692 6.97573 13.0419 6.6924 13.0419 10.0257V15.5007H16.3336V8.8924C16.3336 3.75075 10.4503 3.94242 9.06692 6.4674L9.10025 5.06742Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="twitter">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="14"
                          viewBox="0 0 18 14"
                          fill="none"
                        >
                          <path
                            d="M17.5104 1.71289C16.8743 1.9943 16.1996 2.17914 15.5088 2.26127C16.2366 1.82561 16.7812 1.14026 17.0411 0.332886C16.3573 0.739186 15.6088 1.02515 14.8282 1.17835C14.1693 0.475394 13.2483 0.0770356 12.2848 0.0781272C10.3605 0.0781272 8.79975 1.63835 8.79975 3.56354C8.79975 3.83666 8.83109 4.10153 8.88967 4.35709C5.99206 4.21121 3.42506 2.82455 1.70565 0.715686C1.39608 1.24757 1.23338 1.85216 1.2342 2.46757C1.2342 3.67667 1.84967 4.74388 2.78458 5.36868C2.23115 5.35118 1.6899 5.20171 1.20599 4.93262C1.20545 4.94726 1.20545 4.9619 1.20545 4.97574C1.20545 6.66484 2.40683 8.07384 4.00166 8.39376C3.70234 8.47476 3.3936 8.51568 3.08352 8.51543C2.85831 8.51543 2.63976 8.49468 2.42733 8.45393C2.8711 9.83826 4.15739 10.8461 5.683 10.8738C4.44845 11.8427 2.92391 12.3683 1.35453 12.3661C1.07677 12.3663 0.799246 12.3499 0.523438 12.3171C2.1167 13.3413 3.97127 13.8849 5.86535 13.8829C12.2763 13.8829 15.7817 8.57243 15.7817 3.9671C15.7817 3.81643 15.778 3.66523 15.7713 3.51615C16.4536 3.02322 17.0425 2.41257 17.5104 1.71289Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="instagram">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="18"
                          viewBox="0 0 18 18"
                          fill="none"
                        >
                          <path
                            d="M9.85724 0.671875C10.7951 0.673425 11.2703 0.678392 11.681 0.690617L11.8427 0.6959C12.0296 0.702542 12.2139 0.710875 12.4362 0.721292C13.3229 0.762267 13.9278 0.902542 14.4591 1.10879C15.0083 1.3206 15.4722 1.60671 15.9354 2.06991C16.3979 2.5331 16.6841 2.99837 16.8966 3.54629C17.1021 4.07685 17.2424 4.68241 17.2841 5.56921C17.294 5.79143 17.302 5.97577 17.3086 6.16263L17.3138 6.32437C17.326 6.73499 17.3316 7.21032 17.3333 8.14818L17.334 8.76952C17.3341 8.84543 17.3341 8.92377 17.3341 9.0046L17.334 9.23968L17.3335 9.8611C17.3319 10.7989 17.327 11.2743 17.3147 11.6848L17.3094 11.8466C17.3028 12.0335 17.2945 12.2178 17.2841 12.44C17.2431 13.3268 17.1021 13.9317 16.8966 14.4629C16.6847 15.0123 16.3979 15.4762 15.9354 15.9393C15.4722 16.4018 15.0062 16.6879 14.4591 16.9004C13.9278 17.106 13.3229 17.2463 12.4362 17.2879C12.2139 17.2978 12.0296 17.3059 11.8427 17.3124L11.681 17.3177C11.2703 17.3299 10.7951 17.3354 9.85724 17.3373L9.23582 17.3379C9.1599 17.3379 9.08157 17.3379 9.00074 17.3379H8.76565L8.14424 17.3373C7.2064 17.3358 6.73109 17.3309 6.32046 17.3186L6.15873 17.3134C5.97185 17.3067 5.78752 17.2983 5.5653 17.2879C4.67849 17.247 4.07433 17.106 3.54239 16.9004C2.99377 16.6887 2.52919 16.4018 2.06599 15.9393C1.6028 15.4762 1.31739 15.0102 1.10489 14.4629C0.898636 13.9317 0.759052 13.3268 0.717386 12.44C0.707486 12.2178 0.69941 12.0335 0.692869 11.8466L0.687627 11.6848C0.675435 11.2743 0.669877 10.7989 0.668077 9.8611L0.667969 8.14818C0.669519 7.21032 0.674477 6.73499 0.686702 6.32437L0.691994 6.16263C0.698635 5.97577 0.706969 5.79143 0.717386 5.56921C0.758352 4.68171 0.898636 4.07754 1.10489 3.54629C1.31669 2.99768 1.6028 2.5331 2.06599 2.06991C2.52919 1.60671 2.99447 1.32129 3.54239 1.10879C4.07364 0.902542 4.6778 0.762958 5.5653 0.721292C5.78752 0.7114 5.97185 0.703325 6.15873 0.696783L6.32046 0.691542C6.73109 0.679342 7.2064 0.673783 8.14424 0.671983L9.85724 0.671875ZM9.00074 4.83796C6.6983 4.83796 4.83405 6.70423 4.83405 9.0046C4.83405 11.307 6.70033 13.1713 9.00074 13.1713C11.3032 13.1713 13.1674 11.305 13.1674 9.0046C13.1674 6.70221 11.3011 4.83796 9.00074 4.83796ZM9.00074 6.50462C10.3815 6.50462 11.5007 7.62352 11.5007 9.0046C11.5007 10.3853 10.3818 11.5046 9.00074 11.5046C7.61999 11.5046 6.50072 10.3858 6.50072 9.0046C6.50072 7.62385 7.61957 6.50462 9.00074 6.50462ZM13.3757 3.58796C12.8013 3.58796 12.3341 4.05455 12.3341 4.62892C12.3341 5.20329 12.8007 5.6706 13.3757 5.6706C13.9501 5.6706 14.4174 5.20402 14.4174 4.62892C14.4174 4.05455 13.9493 3.58724 13.3757 3.58796Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="card-team radius18">
                    <img
                      src="{{ asset('front-assets/consulo') }}/img/team/1.jpg"
                      alt="team image"
                      width="500"
                      height="619"
                      loading="lazy"
                    />
                    <div class="card-team-content-absolute">
                      <div class="card-team-content">
                        <a
                          href="{{ route('front.success-stories.index') }}"
                          aria-label="team details"
                          class="heading text-22 fw-600"
                          >Ronald Richards</a
                        >
                        <p class="text text-18">Finance Advisor</p>
                      </div>
                    </div>
                    <div class="social-list">
                      <a href="#" class="svg-wrapper" aria-label="LinkedIn">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="17"
                          height="16"
                          viewBox="0 0 17 16"
                          fill="none"
                        >
                          <path
                            d="M3.78357 2.16742C3.78326 2.84601 3.37157 3.45666 2.74262 3.71142C2.11367 3.96619 1.39306 3.81419 0.920587 3.32711C0.448112 2.84001 0.318129 2.11511 0.59192 1.49421C0.86572 0.873305 1.48862 0.480397 2.1669 0.500755C3.0678 0.527797 3.78398 1.26612 3.78357 2.16742ZM3.83357 5.06742H0.500237V15.5007H3.83357V5.06742ZM9.10025 5.06742H5.78357V15.5007H9.06692V10.0257C9.06692 6.97573 13.0419 6.6924 13.0419 10.0257V15.5007H16.3336V8.8924C16.3336 3.75075 10.4503 3.94242 9.06692 6.4674L9.10025 5.06742Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="twitter">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="14"
                          viewBox="0 0 18 14"
                          fill="none"
                        >
                          <path
                            d="M17.5104 1.71289C16.8743 1.9943 16.1996 2.17914 15.5088 2.26127C16.2366 1.82561 16.7812 1.14026 17.0411 0.332886C16.3573 0.739186 15.6088 1.02515 14.8282 1.17835C14.1693 0.475394 13.2483 0.0770356 12.2848 0.0781272C10.3605 0.0781272 8.79975 1.63835 8.79975 3.56354C8.79975 3.83666 8.83109 4.10153 8.88967 4.35709C5.99206 4.21121 3.42506 2.82455 1.70565 0.715686C1.39608 1.24757 1.23338 1.85216 1.2342 2.46757C1.2342 3.67667 1.84967 4.74388 2.78458 5.36868C2.23115 5.35118 1.6899 5.20171 1.20599 4.93262C1.20545 4.94726 1.20545 4.9619 1.20545 4.97574C1.20545 6.66484 2.40683 8.07384 4.00166 8.39376C3.70234 8.47476 3.3936 8.51568 3.08352 8.51543C2.85831 8.51543 2.63976 8.49468 2.42733 8.45393C2.8711 9.83826 4.15739 10.8461 5.683 10.8738C4.44845 11.8427 2.92391 12.3683 1.35453 12.3661C1.07677 12.3663 0.799246 12.3499 0.523438 12.3171C2.1167 13.3413 3.97127 13.8849 5.86535 13.8829C12.2763 13.8829 15.7817 8.57243 15.7817 3.9671C15.7817 3.81643 15.778 3.66523 15.7713 3.51615C16.4536 3.02322 17.0425 2.41257 17.5104 1.71289Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="instagram">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="18"
                          viewBox="0 0 18 18"
                          fill="none"
                        >
                          <path
                            d="M9.85724 0.671875C10.7951 0.673425 11.2703 0.678392 11.681 0.690617L11.8427 0.6959C12.0296 0.702542 12.2139 0.710875 12.4362 0.721292C13.3229 0.762267 13.9278 0.902542 14.4591 1.10879C15.0083 1.3206 15.4722 1.60671 15.9354 2.06991C16.3979 2.5331 16.6841 2.99837 16.8966 3.54629C17.1021 4.07685 17.2424 4.68241 17.2841 5.56921C17.294 5.79143 17.302 5.97577 17.3086 6.16263L17.3138 6.32437C17.326 6.73499 17.3316 7.21032 17.3333 8.14818L17.334 8.76952C17.3341 8.84543 17.3341 8.92377 17.3341 9.0046L17.334 9.23968L17.3335 9.8611C17.3319 10.7989 17.327 11.2743 17.3147 11.6848L17.3094 11.8466C17.3028 12.0335 17.2945 12.2178 17.2841 12.44C17.2431 13.3268 17.1021 13.9317 16.8966 14.4629C16.6847 15.0123 16.3979 15.4762 15.9354 15.9393C15.4722 16.4018 15.0062 16.6879 14.4591 16.9004C13.9278 17.106 13.3229 17.2463 12.4362 17.2879C12.2139 17.2978 12.0296 17.3059 11.8427 17.3124L11.681 17.3177C11.2703 17.3299 10.7951 17.3354 9.85724 17.3373L9.23582 17.3379C9.1599 17.3379 9.08157 17.3379 9.00074 17.3379H8.76565L8.14424 17.3373C7.2064 17.3358 6.73109 17.3309 6.32046 17.3186L6.15873 17.3134C5.97185 17.3067 5.78752 17.2983 5.5653 17.2879C4.67849 17.247 4.07433 17.106 3.54239 16.9004C2.99377 16.6887 2.52919 16.4018 2.06599 15.9393C1.6028 15.4762 1.31739 15.0102 1.10489 14.4629C0.898636 13.9317 0.759052 13.3268 0.717386 12.44C0.707486 12.2178 0.69941 12.0335 0.692869 11.8466L0.687627 11.6848C0.675435 11.2743 0.669877 10.7989 0.668077 9.8611L0.667969 8.14818C0.669519 7.21032 0.674477 6.73499 0.686702 6.32437L0.691994 6.16263C0.698635 5.97577 0.706969 5.79143 0.717386 5.56921C0.758352 4.68171 0.898636 4.07754 1.10489 3.54629C1.31669 2.99768 1.6028 2.5331 2.06599 2.06991C2.52919 1.60671 2.99447 1.32129 3.54239 1.10879C4.07364 0.902542 4.6778 0.762958 5.5653 0.721292C5.78752 0.7114 5.97185 0.703325 6.15873 0.696783L6.32046 0.691542C6.73109 0.679342 7.2064 0.673783 8.14424 0.671983L9.85724 0.671875ZM9.00074 4.83796C6.6983 4.83796 4.83405 6.70423 4.83405 9.0046C4.83405 11.307 6.70033 13.1713 9.00074 13.1713C11.3032 13.1713 13.1674 11.305 13.1674 9.0046C13.1674 6.70221 11.3011 4.83796 9.00074 4.83796ZM9.00074 6.50462C10.3815 6.50462 11.5007 7.62352 11.5007 9.0046C11.5007 10.3853 10.3818 11.5046 9.00074 11.5046C7.61999 11.5046 6.50072 10.3858 6.50072 9.0046C6.50072 7.62385 7.61957 6.50462 9.00074 6.50462ZM13.3757 3.58796C12.8013 3.58796 12.3341 4.05455 12.3341 4.62892C12.3341 5.20329 12.8007 5.6706 13.3757 5.6706C13.9501 5.6706 14.4174 5.20402 14.4174 4.62892C14.4174 4.05455 13.9493 3.58724 13.3757 3.58796Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="card-team radius18">
                    <img
                      src="{{ asset('front-assets/consulo') }}/img/team/6.jpg"
                      alt="team image"
                      width="500"
                      height="619"
                      loading="lazy"
                    />
                    <div class="card-team-content-absolute">
                      <div class="card-team-content">
                        <a
                          href="{{ route('front.success-stories.index') }}"
                          aria-label="team details"
                          class="heading text-22 fw-600"
                          >Ronald Richards</a
                        >
                        <p class="text text-18">Finance Advisor</p>
                      </div>
                    </div>
                    <div class="social-list">
                      <a href="#" class="svg-wrapper" aria-label="LinkedIn">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="17"
                          height="16"
                          viewBox="0 0 17 16"
                          fill="none"
                        >
                          <path
                            d="M3.78357 2.16742C3.78326 2.84601 3.37157 3.45666 2.74262 3.71142C2.11367 3.96619 1.39306 3.81419 0.920587 3.32711C0.448112 2.84001 0.318129 2.11511 0.59192 1.49421C0.86572 0.873305 1.48862 0.480397 2.1669 0.500755C3.0678 0.527797 3.78398 1.26612 3.78357 2.16742ZM3.83357 5.06742H0.500237V15.5007H3.83357V5.06742ZM9.10025 5.06742H5.78357V15.5007H9.06692V10.0257C9.06692 6.97573 13.0419 6.6924 13.0419 10.0257V15.5007H16.3336V8.8924C16.3336 3.75075 10.4503 3.94242 9.06692 6.4674L9.10025 5.06742Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="twitter">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="14"
                          viewBox="0 0 18 14"
                          fill="none"
                        >
                          <path
                            d="M17.5104 1.71289C16.8743 1.9943 16.1996 2.17914 15.5088 2.26127C16.2366 1.82561 16.7812 1.14026 17.0411 0.332886C16.3573 0.739186 15.6088 1.02515 14.8282 1.17835C14.1693 0.475394 13.2483 0.0770356 12.2848 0.0781272C10.3605 0.0781272 8.79975 1.63835 8.79975 3.56354C8.79975 3.83666 8.83109 4.10153 8.88967 4.35709C5.99206 4.21121 3.42506 2.82455 1.70565 0.715686C1.39608 1.24757 1.23338 1.85216 1.2342 2.46757C1.2342 3.67667 1.84967 4.74388 2.78458 5.36868C2.23115 5.35118 1.6899 5.20171 1.20599 4.93262C1.20545 4.94726 1.20545 4.9619 1.20545 4.97574C1.20545 6.66484 2.40683 8.07384 4.00166 8.39376C3.70234 8.47476 3.3936 8.51568 3.08352 8.51543C2.85831 8.51543 2.63976 8.49468 2.42733 8.45393C2.8711 9.83826 4.15739 10.8461 5.683 10.8738C4.44845 11.8427 2.92391 12.3683 1.35453 12.3661C1.07677 12.3663 0.799246 12.3499 0.523438 12.3171C2.1167 13.3413 3.97127 13.8849 5.86535 13.8829C12.2763 13.8829 15.7817 8.57243 15.7817 3.9671C15.7817 3.81643 15.778 3.66523 15.7713 3.51615C16.4536 3.02322 17.0425 2.41257 17.5104 1.71289Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="instagram">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="18"
                          viewBox="0 0 18 18"
                          fill="none"
                        >
                          <path
                            d="M9.85724 0.671875C10.7951 0.673425 11.2703 0.678392 11.681 0.690617L11.8427 0.6959C12.0296 0.702542 12.2139 0.710875 12.4362 0.721292C13.3229 0.762267 13.9278 0.902542 14.4591 1.10879C15.0083 1.3206 15.4722 1.60671 15.9354 2.06991C16.3979 2.5331 16.6841 2.99837 16.8966 3.54629C17.1021 4.07685 17.2424 4.68241 17.2841 5.56921C17.294 5.79143 17.302 5.97577 17.3086 6.16263L17.3138 6.32437C17.326 6.73499 17.3316 7.21032 17.3333 8.14818L17.334 8.76952C17.3341 8.84543 17.3341 8.92377 17.3341 9.0046L17.334 9.23968L17.3335 9.8611C17.3319 10.7989 17.327 11.2743 17.3147 11.6848L17.3094 11.8466C17.3028 12.0335 17.2945 12.2178 17.2841 12.44C17.2431 13.3268 17.1021 13.9317 16.8966 14.4629C16.6847 15.0123 16.3979 15.4762 15.9354 15.9393C15.4722 16.4018 15.0062 16.6879 14.4591 16.9004C13.9278 17.106 13.3229 17.2463 12.4362 17.2879C12.2139 17.2978 12.0296 17.3059 11.8427 17.3124L11.681 17.3177C11.2703 17.3299 10.7951 17.3354 9.85724 17.3373L9.23582 17.3379C9.1599 17.3379 9.08157 17.3379 9.00074 17.3379H8.76565L8.14424 17.3373C7.2064 17.3358 6.73109 17.3309 6.32046 17.3186L6.15873 17.3134C5.97185 17.3067 5.78752 17.2983 5.5653 17.2879C4.67849 17.247 4.07433 17.106 3.54239 16.9004C2.99377 16.6887 2.52919 16.4018 2.06599 15.9393C1.6028 15.4762 1.31739 15.0102 1.10489 14.4629C0.898636 13.9317 0.759052 13.3268 0.717386 12.44C0.707486 12.2178 0.69941 12.0335 0.692869 11.8466L0.687627 11.6848C0.675435 11.2743 0.669877 10.7989 0.668077 9.8611L0.667969 8.14818C0.669519 7.21032 0.674477 6.73499 0.686702 6.32437L0.691994 6.16263C0.698635 5.97577 0.706969 5.79143 0.717386 5.56921C0.758352 4.68171 0.898636 4.07754 1.10489 3.54629C1.31669 2.99768 1.6028 2.5331 2.06599 2.06991C2.52919 1.60671 2.99447 1.32129 3.54239 1.10879C4.07364 0.902542 4.6778 0.762958 5.5653 0.721292C5.78752 0.7114 5.97185 0.703325 6.15873 0.696783L6.32046 0.691542C6.73109 0.679342 7.2064 0.673783 8.14424 0.671983L9.85724 0.671875ZM9.00074 4.83796C6.6983 4.83796 4.83405 6.70423 4.83405 9.0046C4.83405 11.307 6.70033 13.1713 9.00074 13.1713C11.3032 13.1713 13.1674 11.305 13.1674 9.0046C13.1674 6.70221 11.3011 4.83796 9.00074 4.83796ZM9.00074 6.50462C10.3815 6.50462 11.5007 7.62352 11.5007 9.0046C11.5007 10.3853 10.3818 11.5046 9.00074 11.5046C7.61999 11.5046 6.50072 10.3858 6.50072 9.0046C6.50072 7.62385 7.61957 6.50462 9.00074 6.50462ZM13.3757 3.58796C12.8013 3.58796 12.3341 4.05455 12.3341 4.62892C12.3341 5.20329 12.8007 5.6706 13.3757 5.6706C13.9501 5.6706 14.4174 5.20402 14.4174 4.62892C14.4174 4.05455 13.9493 3.58724 13.3757 3.58796Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="card-team radius18">
                    <img
                      src="{{ asset('front-assets/consulo') }}/img/team/7.jpg"
                      alt="team image"
                      width="500"
                      height="619"
                      loading="lazy"
                    />
                    <div class="card-team-content-absolute">
                      <div class="card-team-content">
                        <a
                          href="{{ route('front.success-stories.index') }}"
                          aria-label="team details"
                          class="heading text-22 fw-600"
                          >Ronald Richards</a
                        >
                        <p class="text text-18">Finance Advisor</p>
                      </div>
                    </div>
                    <div class="social-list">
                      <a href="#" class="svg-wrapper" aria-label="LinkedIn">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="17"
                          height="16"
                          viewBox="0 0 17 16"
                          fill="none"
                        >
                          <path
                            d="M3.78357 2.16742C3.78326 2.84601 3.37157 3.45666 2.74262 3.71142C2.11367 3.96619 1.39306 3.81419 0.920587 3.32711C0.448112 2.84001 0.318129 2.11511 0.59192 1.49421C0.86572 0.873305 1.48862 0.480397 2.1669 0.500755C3.0678 0.527797 3.78398 1.26612 3.78357 2.16742ZM3.83357 5.06742H0.500237V15.5007H3.83357V5.06742ZM9.10025 5.06742H5.78357V15.5007H9.06692V10.0257C9.06692 6.97573 13.0419 6.6924 13.0419 10.0257V15.5007H16.3336V8.8924C16.3336 3.75075 10.4503 3.94242 9.06692 6.4674L9.10025 5.06742Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="twitter">
                        <svg
                          class="icon icon-20"
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="14"
                          viewBox="0 0 18 14"
                          fill="none"
                        >
                          <path
                            d="M17.5104 1.71289C16.8743 1.9943 16.1996 2.17914 15.5088 2.26127C16.2366 1.82561 16.7812 1.14026 17.0411 0.332886C16.3573 0.739186 15.6088 1.02515 14.8282 1.17835C14.1693 0.475394 13.2483 0.0770356 12.2848 0.0781272C10.3605 0.0781272 8.79975 1.63835 8.79975 3.56354C8.79975 3.83666 8.83109 4.10153 8.88967 4.35709C5.99206 4.21121 3.42506 2.82455 1.70565 0.715686C1.39608 1.24757 1.23338 1.85216 1.2342 2.46757C1.2342 3.67667 1.84967 4.74388 2.78458 5.36868C2.23115 5.35118 1.6899 5.20171 1.20599 4.93262C1.20545 4.94726 1.20545 4.9619 1.20545 4.97574C1.20545 6.66484 2.40683 8.07384 4.00166 8.39376C3.70234 8.47476 3.3936 8.51568 3.08352 8.51543C2.85831 8.51543 2.63976 8.49468 2.42733 8.45393C2.8711 9.83826 4.15739 10.8461 5.683 10.8738C4.44845 11.8427 2.92391 12.3683 1.35453 12.3661C1.07677 12.3663 0.799246 12.3499 0.523438 12.3171C2.1167 13.3413 3.97127 13.8849 5.86535 13.8829C12.2763 13.8829 15.7817 8.57243 15.7817 3.9671C15.7817 3.81643 15.778 3.66523 15.7713 3.51615C16.4536 3.02322 17.0425 2.41257 17.5104 1.71289Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>

                      <a href="#" class="svg-wrapper" aria-label="instagram">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="18"
                          height="18"
                          viewBox="0 0 18 18"
                          fill="none"
                        >
                          <path
                            d="M9.85724 0.671875C10.7951 0.673425 11.2703 0.678392 11.681 0.690617L11.8427 0.6959C12.0296 0.702542 12.2139 0.710875 12.4362 0.721292C13.3229 0.762267 13.9278 0.902542 14.4591 1.10879C15.0083 1.3206 15.4722 1.60671 15.9354 2.06991C16.3979 2.5331 16.6841 2.99837 16.8966 3.54629C17.1021 4.07685 17.2424 4.68241 17.2841 5.56921C17.294 5.79143 17.302 5.97577 17.3086 6.16263L17.3138 6.32437C17.326 6.73499 17.3316 7.21032 17.3333 8.14818L17.334 8.76952C17.3341 8.84543 17.3341 8.92377 17.3341 9.0046L17.334 9.23968L17.3335 9.8611C17.3319 10.7989 17.327 11.2743 17.3147 11.6848L17.3094 11.8466C17.3028 12.0335 17.2945 12.2178 17.2841 12.44C17.2431 13.3268 17.1021 13.9317 16.8966 14.4629C16.6847 15.0123 16.3979 15.4762 15.9354 15.9393C15.4722 16.4018 15.0062 16.6879 14.4591 16.9004C13.9278 17.106 13.3229 17.2463 12.4362 17.2879C12.2139 17.2978 12.0296 17.3059 11.8427 17.3124L11.681 17.3177C11.2703 17.3299 10.7951 17.3354 9.85724 17.3373L9.23582 17.3379C9.1599 17.3379 9.08157 17.3379 9.00074 17.3379H8.76565L8.14424 17.3373C7.2064 17.3358 6.73109 17.3309 6.32046 17.3186L6.15873 17.3134C5.97185 17.3067 5.78752 17.2983 5.5653 17.2879C4.67849 17.247 4.07433 17.106 3.54239 16.9004C2.99377 16.6887 2.52919 16.4018 2.06599 15.9393C1.6028 15.4762 1.31739 15.0102 1.10489 14.4629C0.898636 13.9317 0.759052 13.3268 0.717386 12.44C0.707486 12.2178 0.69941 12.0335 0.692869 11.8466L0.687627 11.6848C0.675435 11.2743 0.669877 10.7989 0.668077 9.8611L0.667969 8.14818C0.669519 7.21032 0.674477 6.73499 0.686702 6.32437L0.691994 6.16263C0.698635 5.97577 0.706969 5.79143 0.717386 5.56921C0.758352 4.68171 0.898636 4.07754 1.10489 3.54629C1.31669 2.99768 1.6028 2.5331 2.06599 2.06991C2.52919 1.60671 2.99447 1.32129 3.54239 1.10879C4.07364 0.902542 4.6778 0.762958 5.5653 0.721292C5.78752 0.7114 5.97185 0.703325 6.15873 0.696783L6.32046 0.691542C6.73109 0.679342 7.2064 0.673783 8.14424 0.671983L9.85724 0.671875ZM9.00074 4.83796C6.6983 4.83796 4.83405 6.70423 4.83405 9.0046C4.83405 11.307 6.70033 13.1713 9.00074 13.1713C11.3032 13.1713 13.1674 11.305 13.1674 9.0046C13.1674 6.70221 11.3011 4.83796 9.00074 4.83796ZM9.00074 6.50462C10.3815 6.50462 11.5007 7.62352 11.5007 9.0046C11.5007 10.3853 10.3818 11.5046 9.00074 11.5046C7.61999 11.5046 6.50072 10.3858 6.50072 9.0046C6.50072 7.62385 7.61957 6.50462 9.00074 6.50462ZM13.3757 3.58796C12.8013 3.58796 12.3341 4.05455 12.3341 4.62892C12.3341 5.20329 12.8007 5.6706 13.3757 5.6706C13.9501 5.6706 14.4174 5.20402 14.4174 4.62892C14.4174 4.05455 13.9493 3.58724 13.3757 3.58796Z"
                            fill="currentColor"
                          />
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </team-slider>

      <!-- Testimonial -->
      <div class="testimonial-4 mt-100 overflow-x-hidden">
        <div class="container">
          <div class="testimonial-inner">
            <div class="row product-grid">
              <div class="col-lg-6 col-12">
                <div class="heading-wrapper">
                  <div class="section-headings" data-aos="fade-right">
                    <div class="subheading text-20 subheading-bg">
                      <svg
                        class="icon icon-14"
                        xmlns="http://www.w3.org/2000/svg"
                        width="14"
                        height="14"
                        viewBox="0 0 14 14"
                        fill="none"
                      >
                        <g clip-path="url(#clip0_9088_4143)">
                          <path
                            d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                            fill="CurrentColor"
                          />
                        </g>
                        <defs>
                          <clipPath>
                            <rect width="14" height="14" fill="CurrentColor" />
                          </clipPath>
                        </defs>
                      </svg>
                      <span>Testimonial</span>
                      <svg
                        class="icon icon-14"
                        xmlns="http://www.w3.org/2000/svg"
                        width="14"
                        height="14"
                        viewBox="0 0 14 14"
                        fill="none"
                      >
                        <g clip-path="url(#clip0_9088_4143)">
                          <path
                            d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                            fill="CurrentColor"
                          />
                        </g>
                        <defs>
                          <clipPath>
                            <rect width="14" height="14" fill="CurrentColor" />
                          </clipPath>
                        </defs>
                      </svg>
                    </div>
                    <h2 class="heading text-50">
                      See what our customers have to say about us
                    </h2>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <testicolumn-slider
                  class="team-slider testicolumn-slider"
                  data-aos="fade-left"
                >
                  <div class="swiper">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                        <div class="card-testimonial radius18">
                          <ul class="rating-list list-unstyled">
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                          </ul>
                          <p class="text text-24">
                            “ Working with several word themes and templates the
                            last years only can say this is best in every level
                            use it for my reviews that I have already are
                            company and the reviews that I have already are all
                            excellent. Not only the design but the are company
                            and the reviews code ”
                          </p>
                          <div class="user-info-wrap">
                            <div class="user-info">
                              <div class="user-img">
                                <img
                                  src="{{ asset('front-assets/consulo') }}/img/testimonial/1.jpg"
                                  width="80"
                                  height="80"
                                  loading="lazy"
                                  alt="image"
                                />
                              </div>
                              <div class="user-name-desig">
                                <h2 class="user-name heading text-24">
                                  Marvin Kinney
                                </h2>
                                <div class="user-desig text text-18">
                                  Product Manager
                                </div>
                              </div>
                            </div>
                            <div class="icon-quote">
                              <svg
                                class="icon icon-62"
                                width="62"
                                height="62"
                                viewBox="0 0 62 62"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M14.5312 9.41406C6.51702 9.41406 0 15.9329 0 23.9453C0 31.2606 5.43154 37.3306 12.4771 38.3311C11.9131 42.4287 10.3486 46.3275 7.90415 49.7085C7.42874 50.3683 7.44654 51.2624 7.9538 51.9009C8.4515 52.5292 9.31635 52.7674 10.0754 52.4473C21.6088 47.6332 29.0625 36.4438 29.0625 23.9453C29.0625 15.9329 22.5455 9.41406 14.5312 9.41406ZM47.4688 9.41406C39.4545 9.41406 32.9375 15.9329 32.9375 23.9453C32.9375 31.2606 38.369 37.3306 45.4146 38.3311C44.8506 42.4287 43.2861 46.3275 40.8417 49.7085C40.3662 50.3683 40.384 51.2624 40.8913 51.9009C41.389 52.5292 42.2538 52.7674 43.0129 52.4473C54.5463 47.6332 62 36.4438 62 23.9453C62 15.9329 55.483 9.41406 47.4688 9.41406Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="card-testimonial radius18">
                          <ul class="rating-list list-unstyled">
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                          </ul>
                          <p class="text text-24">
                            “ Working with several word themes and templates the
                            last years only can say this is best in every level
                            use it for my reviews that I have already are
                            company and the reviews that I have already are all
                            excellent. Not only the design but the are company
                            and the reviews code ”
                          </p>
                          <div class="user-info-wrap">
                            <div class="user-info">
                              <div class="user-img">
                                <img
                                  src="{{ asset('front-assets/consulo') }}/img/testimonial/2.jpg"
                                  width="80"
                                  height="80"
                                  loading="lazy"
                                  alt="image"
                                />
                              </div>
                              <div class="user-name-desig">
                                <h2 class="user-name heading text-24">
                                  Charlize Theron
                                </h2>
                                <div class="user-desig text text-18">
                                  Product Manager
                                </div>
                              </div>
                            </div>
                            <div class="icon-quote">
                              <svg
                                class="icon icon-62"
                                width="62"
                                height="62"
                                viewBox="0 0 62 62"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M14.5312 9.41406C6.51702 9.41406 0 15.9329 0 23.9453C0 31.2606 5.43154 37.3306 12.4771 38.3311C11.9131 42.4287 10.3486 46.3275 7.90415 49.7085C7.42874 50.3683 7.44654 51.2624 7.9538 51.9009C8.4515 52.5292 9.31635 52.7674 10.0754 52.4473C21.6088 47.6332 29.0625 36.4438 29.0625 23.9453C29.0625 15.9329 22.5455 9.41406 14.5312 9.41406ZM47.4688 9.41406C39.4545 9.41406 32.9375 15.9329 32.9375 23.9453C32.9375 31.2606 38.369 37.3306 45.4146 38.3311C44.8506 42.4287 43.2861 46.3275 40.8417 49.7085C40.3662 50.3683 40.384 51.2624 40.8913 51.9009C41.389 52.5292 42.2538 52.7674 43.0129 52.4473C54.5463 47.6332 62 36.4438 62 23.9453C62 15.9329 55.483 9.41406 47.4688 9.41406Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="card-testimonial radius18">
                          <ul class="rating-list list-unstyled">
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                            <li class="rating-icon">
                              <svg
                                class="icon icon-24"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </li>
                          </ul>
                          <p class="text text-24">
                            “ Working with several word themes and templates the
                            last years only can say this is best in every level
                            use it for my reviews that I have already are
                            company and the reviews that I have already are all
                            excellent. Not only the design but the are company
                            and the reviews code ”
                          </p>
                          <div class="user-info-wrap">
                            <div class="user-info">
                              <div class="user-img">
                                <img
                                  src="{{ asset('front-assets/consulo') }}/img/testimonial/3.jpg"
                                  width="80"
                                  height="80"
                                  loading="lazy"
                                  alt="image"
                                />
                              </div>
                              <div class="user-name-desig">
                                <h2 class="user-name heading text-24">
                                  Tondu Hosen
                                </h2>
                                <div class="user-desig text text-18">
                                  Ceo & Owner
                                </div>
                              </div>
                            </div>
                            <div class="icon-quote">
                              <svg
                                class="icon icon-62"
                                width="62"
                                height="62"
                                viewBox="0 0 62 62"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M14.5312 9.41406C6.51702 9.41406 0 15.9329 0 23.9453C0 31.2606 5.43154 37.3306 12.4771 38.3311C11.9131 42.4287 10.3486 46.3275 7.90415 49.7085C7.42874 50.3683 7.44654 51.2624 7.9538 51.9009C8.4515 52.5292 9.31635 52.7674 10.0754 52.4473C21.6088 47.6332 29.0625 36.4438 29.0625 23.9453C29.0625 15.9329 22.5455 9.41406 14.5312 9.41406ZM47.4688 9.41406C39.4545 9.41406 32.9375 15.9329 32.9375 23.9453C32.9375 31.2606 38.369 37.3306 45.4146 38.3311C44.8506 42.4287 43.2861 46.3275 40.8417 49.7085C40.3662 50.3683 40.384 51.2624 40.8913 51.9009C41.389 52.5292 42.2538 52.7674 43.0129 52.4473C54.5463 47.6332 62 36.4438 62 23.9453C62 15.9329 55.483 9.41406 47.4688 9.41406Z"
                                  fill="CurrentColor"
                                />
                              </svg>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-pagination"></div>
                </testicolumn-slider>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Featured Blog -->
      <div class="featured-blog blog-style-3 mt-100 section-padding">
        <div class="container">
          <div class="section-headings text-center">
            <div class="subheading subheading-bg text-20" data-aos="fade-up">
              <svg
                class="icon icon-14"
                xmlns="http://www.w3.org/2000/svg"
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
              >
                <g clip-path="url(#clip0_9088_4143)">
                  <path
                    d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                    fill="CurrentColor"
                  />
                </g>
                <defs>
                  <clipPath>
                    <rect width="14" height="14" fill="CurrentColor" />
                  </clipPath>
                </defs>
              </svg>
              <span>Our Blog</span>
              <svg
                class="icon icon-14"
                xmlns="http://www.w3.org/2000/svg"
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
              >
                <g clip-path="url(#clip0_9088_4143)">
                  <path
                    d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 -1.33117e-07 8.0588 0 7C4.62818e-08 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z"
                    fill="CurrentColor"
                  />
                </g>
                <defs>
                  <clipPath>
                    <rect width="14" height="14" fill="CurrentColor" />
                  </clipPath>
                </defs>
              </svg>
            </div>
            <h2 class="heading text-50" data-aos="fade-up" data-aos-delay="50">
              Latest News From Us
            </h2>
          </div>
          <div class="section-content">
            <div class="row product-grid justify-content-center">
              <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up">
                <div class="card-blog-list" data-aos="fade-up">
                  <div class="card-blog-list-media radius18">
                    <div class="media">
                      <img
                        src="{{ asset('front-assets/consulo') }}/img/blog/1.jpg"
                        alt="blog image"
                        width="1000"
                        height="707"
                        loading="lazy"
                      />
                    </div>
                  </div>

                  <h2 class="card-blog-heading heading text-22">
                    <a href="{{ route('front.articles.index') }}" class="heading text-22">
                      Empowering Minds. Accelerating Business Growth.
                    </a>
                  </h2>
                </div>
              </div>
              <div
                class="col-12 col-md-6 col-lg-4"
                data-aos="fade-up"
                data-aos-delay="100"
              >
                <div class="card-blog-list" data-aos="fade-up">
                  <div class="card-blog-list-media radius18">
                    <div class="media">
                      <img
                        src="{{ asset('front-assets/consulo') }}/img/blog/2.jpg"
                        alt="blog image"
                        width="1000"
                        height="707"
                        loading="lazy"
                      />
                    </div>
                  </div>

                  <h2 class="card-blog-heading heading text-22">
                    <a href="{{ route('front.articles.index') }}" class="heading text-22">
                      Insights That Empower Entrepreneurs to Grow
                    </a>
                  </h2>
                </div>
              </div>
              <div
                class="col-12 col-md-6 col-lg-4"
                data-aos="fade-up"
                data-aos-delay="200"
              >
                <div class="card-blog-list" data-aos="fade-up">
                  <div class="card-blog-list-media radius18">
                    <div class="media">
                      <img
                        src="{{ asset('front-assets/consulo') }}/img/blog/3.jpg"
                        alt="blog image"
                        width="1000"
                        height="707"
                        loading="lazy"
                      />
                    </div>
                  </div>

                  <h2 class="card-blog-heading heading text-22">
                    <a href="{{ route('front.articles.index') }}" class="heading text-22">
                      Empowering entrepreneu fueling growth knowledge
                    </a>
                  </h2>
                </div>
              </div>
            </div>

            <div
              class="buttons buttons-discover"
              data-aos="fade-up"
              data-aos-delay="100"
            >
              <a
                href="{{ route('front.articles.index') }}"
                class="button button--primary"
                aria-label="Discover more blog posts"
              >
                Discover More
                <span class="svg-wrapper">
                  <svg
                    class="icon-20"
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z"
                      fill="CurrentColor"
                    />
                  </svg>
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer>
      <!-- Footer Main -->
      <div
        class="footer-main bg-contain"
        style="background-image: url({{ asset('front-assets/consulo') }}/img/footer/footer-bg-large.jpg)"
      >
        <div class="footer-top">
          <div class="container">
            <div class="row footer-custom-row">
              <div class="col-12 col-md-6">
                <div
                  class="footer-widget footer-widget-brand"
                  data-aos="fade-up"
                  data-aos-anchor=".footer-top"
                >
                  <a
                    class="footer-logo"
                    href="{{ route('front.home') }}"
                    aria-label="Consulo Logo"
                  >
                    <img
                      src="{{ asset('front-assets/consulo') }}/img/logo-white.png"
                      alt="Consulo Logo"
                      width="189"
                      height="32"
                      loading="lazy"
                    />
                  </a>
                  <p class="text text-16">
                    Each demo built with Teba will look different. You can
                    customize almost anything in the appearance of your website
                    with only a few
                  </p>
                  <ul
                    class="social-icons list-unstyled"
                    data-aos="fade-up"
                    data-aos-anchor=".footer-top"
                  >
                    <li>
                      <a
                        class="social-link text"
                        href="https://web.facebook.com/"
                      >
                        <svg
                          width="10"
                          height="18"
                          viewBox="0 0 10 18"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M6.66634 10.2552H8.74967L9.58301 6.92188H6.66634V5.25521C6.66634 4.39739 6.66634 3.58854 8.33301 3.58854H9.58301V0.788625C9.31159 0.752583 8.28551 0.671875 7.20209 0.671875C4.94001 0.671875 3.33301 2.05259 3.33301 4.5883V6.92188H0.833008V10.2552H3.33301V17.3385H6.66634V10.2552Z"
                            fill="currentColor"
                          />
                        </svg>
                        <span class="visually-hidden">Facebook</span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="social-link text"
                        href="https://www.linkedin.com/"
                      >
                        <svg
                          width="17"
                          height="16"
                          viewBox="0 0 17 16"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M3.78357 2.16742C3.78326 2.84601 3.37157 3.45666 2.74262 3.71142C2.11367 3.96619 1.39306 3.81419 0.920587 3.32711C0.448112 2.84001 0.318129 2.11511 0.59192 1.49421C0.86572 0.873305 1.48862 0.480397 2.1669 0.500755C3.0678 0.527797 3.78398 1.26612 3.78357 2.16742ZM3.83357 5.06742H0.500237V15.5007H3.83357V5.06742ZM9.10025 5.06742H5.78357V15.5007H9.06692V10.0257C9.06692 6.97573 13.0419 6.6924 13.0419 10.0257V15.5007H16.3336V8.8924C16.3336 3.75075 10.4503 3.94242 9.06692 6.4674L9.10025 5.06742Z"
                            fill="currentColor"
                          />
                        </svg>
                        <span class="visually-hidden">Linkedin</span>
                      </a>
                    </li>
                    <li>
                      <a class="social-link text" href="https://x.com/">
                        <svg
                          width="18"
                          height="14"
                          viewBox="0 0 18 14"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M17.5104 1.71289C16.8743 1.9943 16.1996 2.17914 15.5088 2.26127C16.2366 1.82561 16.7812 1.14026 17.0411 0.332886C16.3573 0.739186 15.6088 1.02515 14.8282 1.17835C14.1693 0.475394 13.2483 0.0770356 12.2848 0.0781272C10.3605 0.0781272 8.79975 1.63835 8.79975 3.56354C8.79975 3.83666 8.83109 4.10153 8.88967 4.35709C5.99206 4.21121 3.42506 2.82455 1.70565 0.715686C1.39608 1.24757 1.23338 1.85216 1.2342 2.46757C1.2342 3.67667 1.84967 4.74388 2.78458 5.36868C2.23115 5.35118 1.6899 5.20171 1.20599 4.93262C1.20545 4.94726 1.20545 4.9619 1.20545 4.97574C1.20545 6.66484 2.40683 8.07384 4.00166 8.39376C3.70234 8.47476 3.3936 8.51568 3.08352 8.51543C2.85831 8.51543 2.63976 8.49468 2.42733 8.45393C2.8711 9.83826 4.15739 10.8461 5.683 10.8738C4.44845 11.8427 2.92391 12.3683 1.35453 12.3661C1.07677 12.3663 0.799246 12.3499 0.523438 12.3171C2.1167 13.3413 3.97127 13.8849 5.86535 13.8829C12.2763 13.8829 15.7817 8.57243 15.7817 3.9671C15.7817 3.81643 15.778 3.66523 15.7713 3.51615C16.4536 3.02322 17.0425 2.41257 17.5104 1.71289Z"
                            fill="currentColor"
                          />
                        </svg>
                        <span class="visually-hidden">Twitter</span>
                      </a>
                    </li>
                    <li>
                      <a
                        class="social-link text"
                        href="https://www.instagram.com/"
                      >
                        <svg
                          width="18"
                          height="18"
                          viewBox="0 0 18 18"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M9.85724 0.671875C10.7951 0.673425 11.2703 0.678392 11.681 0.690617L11.8427 0.6959C12.0296 0.702542 12.2139 0.710875 12.4362 0.721292C13.3229 0.762267 13.9278 0.902542 14.4591 1.10879C15.0083 1.3206 15.4722 1.60671 15.9354 2.06991C16.3979 2.5331 16.6841 2.99837 16.8966 3.54629C17.1021 4.07685 17.2424 4.68241 17.2841 5.56921C17.294 5.79143 17.302 5.97577 17.3086 6.16263L17.3138 6.32437C17.326 6.73499 17.3316 7.21032 17.3333 8.14818L17.334 8.76952C17.3341 8.84543 17.3341 8.92377 17.3341 9.0046L17.334 9.23968L17.3335 9.8611C17.3319 10.7989 17.327 11.2743 17.3147 11.6848L17.3094 11.8466C17.3028 12.0335 17.2945 12.2178 17.2841 12.44C17.2431 13.3268 17.1021 13.9317 16.8966 14.4629C16.6847 15.0123 16.3979 15.4762 15.9354 15.9393C15.4722 16.4018 15.0062 16.6879 14.4591 16.9004C13.9278 17.106 13.3229 17.2463 12.4362 17.2879C12.2139 17.2978 12.0296 17.3059 11.8427 17.3124L11.681 17.3177C11.2703 17.3299 10.7951 17.3354 9.85724 17.3373L9.23582 17.3379C9.1599 17.3379 9.08157 17.3379 9.00074 17.3379H8.76565L8.14424 17.3373C7.2064 17.3358 6.73109 17.3309 6.32046 17.3186L6.15873 17.3134C5.97185 17.3067 5.78752 17.2983 5.5653 17.2879C4.67849 17.247 4.07433 17.106 3.54239 16.9004C2.99377 16.6887 2.52919 16.4018 2.06599 15.9393C1.6028 15.4762 1.31739 15.0102 1.10489 14.4629C0.898636 13.9317 0.759052 13.3268 0.717386 12.44C0.707486 12.2178 0.69941 12.0335 0.692869 11.8466L0.687627 11.6848C0.675435 11.2743 0.669877 10.7989 0.668077 9.8611L0.667969 8.14818C0.669519 7.21032 0.674477 6.73499 0.686702 6.32437L0.691994 6.16263C0.698635 5.97577 0.706969 5.79143 0.717386 5.56921C0.758352 4.68171 0.898636 4.07754 1.10489 3.54629C1.31669 2.99768 1.6028 2.5331 2.06599 2.06991C2.52919 1.60671 2.99447 1.32129 3.54239 1.10879C4.07364 0.902542 4.6778 0.762958 5.5653 0.721292C5.78752 0.7114 5.97185 0.703325 6.15873 0.696783L6.32046 0.691542C6.73109 0.679342 7.2064 0.673783 8.14424 0.671983L9.85724 0.671875ZM9.00074 4.83796C6.6983 4.83796 4.83405 6.70423 4.83405 9.0046C4.83405 11.307 6.70033 13.1713 9.00074 13.1713C11.3032 13.1713 13.1674 11.305 13.1674 9.0046C13.1674 6.70221 11.3011 4.83796 9.00074 4.83796ZM9.00074 6.50462C10.3815 6.50462 11.5007 7.62352 11.5007 9.0046C11.5007 10.3853 10.3818 11.5046 9.00074 11.5046C7.61999 11.5046 6.50072 10.3858 6.50072 9.0046C6.50072 7.62385 7.61957 6.50462 9.00074 6.50462ZM13.3757 3.58796C12.8013 3.58796 12.3341 4.05455 12.3341 4.62892C12.3341 5.20329 12.8007 5.6706 13.3757 5.6706C13.9501 5.6706 14.4174 5.20402 14.4174 4.62892C14.4174 4.05455 13.9493 3.58724 13.3757 3.58796Z"
                            fill="currentColor"
                          />
                        </svg>
                        <span class="visually-hidden">Instagram</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div
                  class="footer-widget footer-widget-menu"
                  data-aos="fade-up"
                  data-aos-anchor=".footer-top"
                >
                  <div class="widget-heading heading text-22">Quick Link</div>
                  <ul class="footer-menu list-unstyled">
                    <li>
                      <a
                        href="{{ route('front.home') }}"
                        class="text text-16 link"
                        aria-label="About Us"
                      >
                        About Us
                      </a>
                    </li>
                    <li>
                      <a
                        href="{{ route('front.success-stories.index') }}"
                        class="text text-16 link"
                        aria-label="Our Team"
                      >
                        Our Team
                      </a>
                    </li>
                    <li>
                      <a
                        href="{{ route('front.resources.index') }}"
                        class="text text-16 link"
                        aria-label="Pricing Plans"
                      >
                        Pricing Plans
                      </a>
                    </li>
                    <li>
                      <a
                        href="{{ route('front.articles.index') }}"
                        class="text text-16 link"
                        aria-label="Blogs"
                      >
                        Blogs
                      </a>
                    </li>
                    <li>
                      <a
                        href="#contact"
                        class="text text-16 link"
                        aria-label="Blogs"
                      >
                        Contact Us
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div
                  class="footer-widget footer-widget-menu"
                  data-aos="fade-up"
                  data-aos-anchor=".footer-top"
                >
                  <div class="widget-heading heading text-22">Services</div>
                  <ul class="footer-menu list-unstyled">
                    <li>
                      <a
                        href="{{ route('front.galleries.index') }}"
                        class="text text-16 link"
                        aria-label="UI/UX Design"
                      >
                        UI/UX Design
                      </a>
                    </li>
                    <li>
                      <a
                        href="{{ route('front.success-stories.index') }}"
                        class="text text-16 link"
                        aria-label="App Development"
                      >
                        App Development
                      </a>
                    </li>
                    <li>
                      <a
                        href="{{ route('front.activities.index') }}"
                        class="text text-16 link"
                        aria-label="Digital Marketing"
                      >
                        Digital Marketing
                      </a>
                    </li>
                    <li>
                      <a
                        href="{{ route('front.articles.index') }}"
                        class="text text-16 link"
                        aria-label="Web Development"
                        >Web Development</a
                      >
                    </li>
                    <li>
                      <a
                        href="#contact"
                        class="text text-16 link"
                        aria-label="Cyber Security"
                      >
                        Cyber Security
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div
                  class="footer-widget footer-widget-menu"
                  data-aos="fade-up"
                  data-aos-anchor=".footer-top"
                >
                  <div class="widget-heading heading text-22">Information</div>
                  <ul class="footer-menu list-unstyled">
                    <li>
                      <a
                        href="{{ route('front.home') }}"
                        class="text text-16 link"
                        aria-label="Working Process"
                      >
                        Working Process
                      </a>
                    </li>
                    <li>
                      <a
                        href="{{ route('front.home') }}"
                        class="text text-16 link"
                        aria-label="Privacy Policy"
                      >
                        Privacy Policy
                      </a>
                    </li>
                    <li>
                      <a
                        href="{{ route('front.home') }}"
                        class="text text-16 link"
                        aria-label="Terms & Conditions"
                      >
                        Terms & Conditions
                      </a>
                    </li>
                    <li>
                      <a
                        href="{{ route('front.resources.index') }}"
                        class="text text-16 link"
                        aria-label="FAQ"
                      >
                        Faqs
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-bottom">
          <div class="container">
            <div class="row footer-bottom-row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="footer-copyright text text-16">
                  Copyright ©<span class="current-year"></span> SpreeThemes. All
                  rights reserved.
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <ul class="footer-menu footer-policies list-unstyled">
                  <li>
                    <a
                      href="{{ route('front.home') }}"
                      class="text text-16 link"
                      aria-label="Privacy Policy"
                    >
                      Privacy Policy
                    </a>
                  </li>
                  <li>
                    <a
                      href="{{ route('front.resources.index') }}"
                      class="text text-16 link"
                      aria-label="FAQ"
                    >
                      Faqs
                    </a>
                  </li>
                  <li>
                    <a
                      href="#contact"
                      class="text text-16 link"
                      aria-label="FAQ"
                    >
                      Contact
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Modal and Drawer Overlay -->
    <drawer-opener id="drawer-overlay"></drawer-opener>

    <!-- Scroll to Top Button -->
    <scroll-top>
      <div class="scroll-to-top">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="m4.5 15.75 7.5-7.5 7.5 7.5"
          />
        </svg>
      </div>
    </scroll-top>

    <!-- all js -->
    <script src="{{ asset('front-assets/consulo') }}/js/vendor.js" defer></script>
    <script src="{{ asset('front-assets/consulo') }}/js/main.js" defer></script>
  </body>

</html>

