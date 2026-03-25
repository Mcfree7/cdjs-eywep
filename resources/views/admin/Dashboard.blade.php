@extends('admin.layouts.admin')

@push('styles')
  <style>
    .dashboard-hero {
      margin-bottom: 1.5rem;
      border-radius: 1.25rem;
      overflow: hidden;
      box-shadow: 0 1rem 2.5rem rgba(15, 23, 42, 0.14);
    }

    .dashboard-hero .carousel-item {
      height: clamp(280px, 46vw, 520px);
    }

    .dashboard-hero .carousel-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .dashboard-hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(90deg, rgba(15, 23, 42, 0.78) 0%, rgba(15, 23, 42, 0.28) 48%, rgba(15, 23, 42, 0.1) 100%);
      z-index: 1;
    }

    .dashboard-hero-caption {
      position: absolute;
      inset: auto auto 0 0;
      z-index: 2;
      width: min(100%, 720px);
      padding: 2rem;
      color: #fff;
    }

    .dashboard-hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.45rem 0.9rem;
      margin-bottom: 1rem;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.14);
      backdrop-filter: blur(8px);
      font-size: 0.85rem;
      letter-spacing: 0.04em;
      text-transform: uppercase;
    }

    .dashboard-hero-caption h2 {
      margin-bottom: 0.75rem;
      font-size: clamp(1.75rem, 4vw, 3rem);
      font-weight: 700;
    }

    .dashboard-hero-caption p {
      margin-bottom: 0;
      max-width: 52rem;
      font-size: clamp(0.95rem, 1.6vw, 1.1rem);
      color: rgba(255, 255, 255, 0.88);
    }

    .dashboard-hero .carousel-control-prev,
    .dashboard-hero .carousel-control-next {
      width: 8%;
      z-index: 3;
    }

    .dashboard-hero .carousel-indicators {
      z-index: 3;
      margin-bottom: 1rem;
    }

    @media (max-width: 767.98px) {
      .dashboard-hero {
        border-radius: 1rem;
      }

      .dashboard-hero-caption {
        padding: 1.25rem;
      }
    }

    .dashboard-header {
      background: #fff;
      padding: 1.2rem 1.5rem;
      border-radius: 1rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    .dashboard-title h3 {
      font-family: inherit; /* même police que le tableau */
      font-weight: 600; /* proche des th des tables */
      font-size: 1.25rem; /* taille harmonisée */
      color: #212529;
    }

    .dashboard-subtitle {
      font-family: inherit;
    }

    .small-box .inner h3,
    .small-box .inner p,
    .dashboard-hero-caption h2,
    .dashboard-hero-caption p {
      font-family: inherit;
    }
  </style>
@endpush

  @section('content')
   <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">

            <div class="dashboard-header d-flex justify-content-between align-items-center flex-wrap">

              <!-- LEFT -->
              <div class="dashboard-title">
                <h3 class="mb-0">Dashboard</h3>
                <span class="dashboard-subtitle">Aperçu général du système</span>
              </div>

              <!-- RIGHT -->
              <div>
                <!-- No button for dashboard -->
              </div>

            </div>

            <!-- Breadcrumb -->
            <div class="row mt-2">
              <div class="col-sm-12">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 1-->
                <div class="small-box text-bg-primary">
                  <div class="inner">
                    <h3>{{ $stats['articles'] }}</h3>

                    <p>Articles</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"
                    ></path>
                  </svg>
                  <a
                    href="{{ route('articles.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    Voir les articles <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 1-->
              </div>
              <!--end::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 2-->
                <div class="small-box text-bg-success">
                  <div class="inner">
                    <h3>{{ $stats['activities'] }}</h3>

                    <p>Activites</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"
                    ></path>
                  </svg>
                  <a
                    href="{{ route('activities.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    Voir les activites <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 2-->
              </div>
              <!--end::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 3-->
                <div class="small-box text-bg-warning">
                  <div class="inner">
                    <h3>{{ $stats['resources'] }}</h3>

                    <p>Ressources</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"
                    ></path>
                  </svg>
                  <a
                    href="{{ route('admin.resources.index') }}"
                    class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    Voir les ressources <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 3-->
              </div>
              <!--end::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 4-->
                <div class="small-box text-bg-danger">
                  <div class="inner">
                    <h3>{{ $stats['successStories'] }}</h3>

                    <p>Success Stories</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
                    ></path>
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
                    ></path>
                  </svg>
                  <a
                    href="{{ route('success-stories.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    Voir les success stories <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 4-->
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="dashboard-hero">
              <div id="dashboardHeroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-indicators">
                  @foreach ($heroImages as $index => $heroImage)
                    <button
                      type="button"
                      data-bs-target="#dashboardHeroCarousel"
                      data-bs-slide-to="{{ $index }}"
                      class="{{ $index === 0 ? 'active' : '' }}"
                      aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                      aria-label="Slide {{ $index + 1 }}"
                    ></button>
                  @endforeach
                </div>

                <div class="carousel-inner">
                  @foreach ($heroImages as $index => $heroImage)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                      <div class="dashboard-hero-overlay"></div>
                      <img src="{{ $heroImage }}" alt="Image du carousel {{ $index + 1 }}">
                    </div>
                  @endforeach
                </div>

                <div class="dashboard-hero-caption">
                  <span class="dashboard-hero-badge">
                    <i class="bi bi-images"></i>
                    Tableau de bord
                  </span>
                  <h2>{{ $companyName }}</h2>
                  <p>{{ $companySlogan }}</p>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#dashboardHeroCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#dashboardHeroCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
            <!-- /.row (main row) -->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
  @endsection
