@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp
@extends('front.layouts.app')

@section('title', $article->titre . ' - ' . ($settings->company_name ?? 'EYWEP'))
@section('description', Str::limit(strip_tags($article->description), 160))

@push('styles')
<style>
.recent-post .card-blog-heading a {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush

@section('content')
<main>

    @include('front.partials.page-banner', [
        'bannerTitle'      => $article->titre,
        'breadcrumbParent' => ['label' => 'Articles', 'url' => route('front.articles.index')],
    ])

    <!-- Blog Details -->
    <div class="page-blog-details mt-100">
        <div class="container">
            <div class="row">

                {{-- Contenu principal --}}
                <div class="col-12 col-lg-7">
                    <div class="blog-details">
                        <div class="card-blog-list" data-aos="fade-up">

                            @if ($article->images->count() > 1)
                            {{-- Slider multi-images --}}
                            <div class="article-images-swiper swiper radius18">
                                <div class="swiper-wrapper">
                                    @foreach ($article->images as $img)
                                    <div class="swiper-slide">
                                        <div class="card-blog-list-media radius18">
                                            <div class="media">
                                                <img
                                                    src="{{ Storage::url($img->image_path) }}"
                                                    alt="{{ $article->titre }}"
                                                    width="1000"
                                                    height="707"
                                                    loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            @elseif ($article->coverImage)
                            {{-- Image unique --}}
                            <div class="card-blog-list-media radius18">
                                <div class="media">
                                    <img
                                        src="{{ Storage::url($article->coverImage->image_path) }}"
                                        alt="{{ $article->titre }}"
                                        width="1000"
                                        height="707"
                                        loading="eager"
                                    >
                                </div>
                            </div>
                            @endif

                            <div class="card-blog-content">
                                <div class="card-blog-meta">
                                    <div class="card-blog-meta-item text text-18">
                                        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.00098 0.650391C11.499 0.650391 13.5437 2.69437 13.5439 5.19238C13.5439 7.69056 11.4992 9.73535 9.00098 9.73535C6.50299 9.73517 4.45898 7.69045 4.45898 5.19238C4.45919 2.69448 6.50308 0.650569 9.00098 0.650391Z" stroke="currentColor" stroke-width="1.3"/>
                                            <path d="M5.2041 11.4092C5.22954 11.4041 5.2933 11.4126 5.34375 11.4502L5.34863 11.4531C6.41552 12.2405 7.68474 12.6464 8.99902 12.6465C10.3135 12.6465 11.5834 12.2407 12.6504 11.4531L12.6553 11.4502C12.6717 11.4383 12.7412 11.4086 12.8506 11.418C14.4691 11.6454 15.9118 12.559 16.8516 13.9482L16.8555 13.9531C17.0155 14.1843 17.152 14.4246 17.2607 14.6719C17.1428 14.8756 17.0147 15.073 16.8711 15.2705L16.7158 15.4775L16.708 15.4883C16.4195 15.8798 16.0836 16.2387 15.7285 16.5938C15.4317 16.8905 15.0922 17.1871 14.7559 17.4395C13.0785 18.6922 11.0607 19.3506 8.97656 19.3506C6.89732 19.3505 4.88498 18.6944 3.20996 17.4473C2.84577 17.1514 2.51261 16.8807 2.22559 16.5938L2.21875 16.5859L2.21094 16.5801L1.95215 16.3242C1.69963 16.0639 1.46736 15.7886 1.24609 15.4883L1.24316 15.4834L0.944336 15.0703C0.86428 14.9535 0.788425 14.8348 0.71875 14.7178C0.835661 14.4569 0.982086 14.185 1.14258 13.9531C2.06835 12.5567 3.53571 11.6401 5.16504 11.416L5.2041 11.4092Z" stroke="currentColor" stroke-width="1.3"/>
                                        </svg>
                                        Admin
                                    </div>
                                    @if ($article->datePublication)
                                    <div class="card-blog-meta-item text text-18">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.1667 10.6667C13.3877 10.6667 13.5996 10.5789 13.7559 10.4226C13.9122 10.2663 14 10.0543 14 9.83333C14 9.61232 13.9122 9.40036 13.7559 9.24408C13.5996 9.0878 13.3877 9 13.1667 9C12.9457 9 12.7337 9.0878 12.5774 9.24408C12.4211 9.40036 12.3333 9.61232 12.3333 9.83333C12.3333 10.0543 12.4211 10.2663 12.5774 10.4226C12.7337 10.5789 12.9457 10.6667 13.1667 10.6667Z" fill="currentColor"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.83268 0.453125C4.99844 0.453125 5.15741 0.518973 5.27462 0.636183C5.39183 0.753394 5.45768 0.912365 5.45768 1.07812V1.71396C6.00935 1.70312 6.61685 1.70312 7.28518 1.70312H10.7127C11.3818 1.70312 11.9893 1.70312 12.541 1.71396V1.07812C12.541 0.912365 12.6069 0.753394 12.7241 0.636183C12.8413 0.518973 13.0003 0.453125 13.166 0.453125C13.3318 0.453125 13.4907 0.518973 13.608 0.636183C13.7252 0.753394 13.791 0.912365 13.791 1.07812V1.76729C14.0077 1.78396 14.2127 1.80479 14.4068 1.83063C15.3835 1.96229 16.1743 2.23896 16.7985 2.86229C17.4218 3.48646 17.6985 4.27729 17.8302 5.25396C17.9577 6.20396 17.9577 7.41646 17.9577 8.94812V10.7081C17.9577 12.2398 17.9577 13.4531 17.8302 14.4023C17.6985 15.379 17.4218 16.1698 16.7985 16.794C16.1743 17.4173 15.3835 17.694 14.4068 17.8256C13.4568 17.9531 12.2443 17.9531 10.7127 17.9531H7.28602C5.75435 17.9531 4.54102 17.9531 3.59185 17.8256C2.61518 17.694 1.82435 17.4173 1.20018 16.794C0.576849 16.1698 0.300182 15.379 0.168516 14.4023C0.0410156 13.4523 0.0410156 12.2398 0.0410156 10.7081V8.94812C0.0410156 7.41646 0.0410156 6.20312 0.168516 5.25396C0.300182 4.27729 0.576849 3.48646 1.20018 2.86229C1.82435 2.23896 2.61518 1.96229 3.59185 1.83063C3.78602 1.80479 3.99185 1.78396 4.20768 1.76729V1.07812C4.20768 0.912365 4.27353 0.753394 4.39074 0.636183C4.50795 0.518973 4.66692 0.453125 4.83268 0.453125ZM3.75768 3.06979C2.92018 3.18229 2.43685 3.39396 2.08435 3.74646C1.73185 4.09896 1.52018 4.58229 1.40768 5.42062C1.38852 5.56229 1.37268 5.71229 1.35935 5.86979H16.6393C16.626 5.71146 16.6102 5.56229 16.591 5.41979C16.4785 4.58229 16.2668 4.09896 15.9143 3.74646C15.5618 3.39396 15.0785 3.18229 14.2402 3.06979C13.3843 2.95479 12.2552 2.95312 10.666 2.95312H7.33268C5.74352 2.95312 4.61518 2.95479 3.75768 3.06979ZM1.29102 8.99479C1.29102 8.28312 1.29102 7.66396 1.30185 7.11979H16.6968C16.7077 7.66396 16.7077 8.28312 16.7077 8.99479V10.6615C16.7077 12.2506 16.706 13.3798 16.591 14.2365C16.4785 15.074 16.2668 15.5573 15.9143 15.9098C15.5618 16.2623 15.0785 16.474 14.2402 16.5865C13.3843 16.7015 12.2552 16.7031 10.666 16.7031H7.33268C5.74352 16.7031 4.61518 16.7015 3.75768 16.5865C2.92018 16.474 2.43685 16.2623 2.08435 15.9098C1.73185 15.5573 1.52018 15.074 1.40768 14.2356C1.29268 13.3798 1.29102 12.2506 1.29102 10.6615V8.99479Z" fill="currentColor"/>
                                        </svg>
                                        {{ $article->datePublication->format('d M Y') }}
                                    </div>
                                    @endif
                                </div>

                                <h2 class="card-blog-heading heading text-50">{{ $article->titre }}</h2>

                                <div class="blog-description">
                                    {!! $article->description !!}
                                </div>
                            </div>
                        </div>

                        <div class="blog-share" data-aos="fade-up">
                            <div class="blog-share-item">
                                <h2 class="label heading text-16 fw-500">Partager :</h2>
                                <ul class="social-icons list-unstyled">
                                    @if ($settings->social_facebook)
                                    <li>
                                        <a class="social-link text" href="{{ $settings->social_facebook }}" target="_blank" rel="noopener">
                                            <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.66634 10.2552H8.74967L9.58301 6.92188H6.66634V5.25521C6.66634 4.39739 6.66634 3.58854 8.33301 3.58854H9.58301V0.788625C9.31159 0.752583 8.28551 0.671875 7.20209 0.671875C4.94001 0.671875 3.33301 2.05259 3.33301 4.5883V6.92188H0.833008V10.2552H3.33301V17.3385H6.66634V10.2552Z" fill="currentColor"/>
                                            </svg>
                                            <span class="visually-hidden">Facebook</span>
                                        </a>
                                    </li>
                                    @endif
                                    @if ($settings->social_linkedin)
                                    <li>
                                        <a class="social-link text" href="{{ $settings->social_linkedin }}" target="_blank" rel="noopener">
                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3.78357 2.16742C3.78326 2.84601 3.37157 3.45666 2.74262 3.71142C2.11367 3.96619 1.39306 3.81419 0.920587 3.32711C0.448112 2.84001 0.318129 2.11511 0.59192 1.49421C0.86572 0.873305 1.48862 0.480397 2.1669 0.500755C3.0678 0.527797 3.78398 1.26612 3.78357 2.16742ZM3.83357 5.06742H0.500237V15.5007H3.83357V5.06742ZM9.10025 5.06742H5.78357V15.5007H9.06692V10.0257C9.06692 6.97573 13.0419 6.6924 13.0419 10.0257V15.5007H16.3336V8.8924C16.3336 3.75075 10.4503 3.94242 9.06692 6.4674L9.10025 5.06742Z" fill="currentColor"/>
                                            </svg>
                                            <span class="visually-hidden">LinkedIn</span>
                                        </a>
                                    </li>
                                    @endif
                                    @if ($settings->social_twitter)
                                    <li>
                                        <a class="social-link text" href="{{ $settings->social_twitter }}" target="_blank" rel="noopener">
                                            <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.1 1.65C16.5 1.95 15.9 2.1 15.15 2.25C15.9 1.8 16.5 1.05 16.8 0.15C16.05 0.6 15.3 0.9 14.4 1.05C13.65 0.3 12.75 0 11.7 0C9.6 0 7.95 1.65 7.95 3.75C7.95 4.05 8.1 4.35 8.1 4.65C5.1 4.5 2.4 3.15 0.75 0.9C0.45 1.35 0.3 1.95 0.3 2.55C0.3 3.75 0.9 4.8 1.8 5.55C1.2 5.55 0.6 5.4 0.15 5.1C0.15 7.05 1.5 8.7 3.3 9C3 9.15 2.7 9.15 2.4 9.15C2.1 9.15 1.95 9.15 1.65 9.15C2.1 10.8 3.6 12 5.4 12C4.05 13.05 2.4 13.65 0.6 13.65C0.3 13.65 0.15 13.65 0 13.65C1.8 14.7 3.9 15.3 6 15.3C11.7 15.3 14.85 9.3 14.85 4.2V3.75C15.6 3.15 16.2 2.55 17.1 1.65Z" fill="currentColor"/>
                                            </svg>
                                            <span class="visually-hidden">Twitter / X</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-12 col-lg-5">
                    <div class="sidebar-filter">
                        <aside class="blog-sidebar">

                            {{-- Articles récents / similaires --}}
                            @if (isset($relatedArticles) && $relatedArticles->isNotEmpty())
                            <div class="sidebar-widget radius18" data-aos="fade-up">
                                <h2 class="sidebar-heading heading text-24">Articles récents</h2>
                                <ul class="recent-post list-unstyled">
                                    @foreach ($relatedArticles as $related)
                                    <li>
                                        <div class="card-blog-list">
                                            <div class="card-blog-list-media">
                                                <div class="media">
                                                    <img
                                                        src="{{ $related->coverImage ? Storage::url($related->coverImage->image_path) : asset('front-assets/consulo/img/blog/1.jpg') }}"
                                                        alt="{{ $related->titre }}"
                                                        width="1000"
                                                        height="707"
                                                        loading="lazy"
                                                    >
                                                </div>
                                            </div>
                                            <div class="card-blog-content">
                                                <div class="card-blog-meta">
                                                    @if ($related->datePublication)
                                                    <div class="card-blog-meta-item text text-16">
                                                        {{ $related->datePublication->format('d M Y') }}
                                                    </div>
                                                    @endif
                                                </div>
                                                <h2 class="card-blog-heading heading text-20">
                                                    <a href="{{ route('front.articles.show', $related) }}" class="heading text-20">
                                                        {{ $related->titre }}
                                                    </a>
                                                </h2>
                                                <div class="buttons">
                                                    <a href="{{ route('front.articles.show', $related) }}" class="button--cta" aria-label="Lire l'article">
                                                        Lire la suite
                                                        <svg viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M14.6895 7.25095H0.75C0.551088 7.25095 0.360322 7.32997 0.21967 7.47062C0.0790178 7.61127 0 7.80203 0 8.00095C0 8.19986 0.0790178 8.39063 0.21967 8.53128C0.360322 8.67193 0.551088 8.75095 0.75 8.75095H14.6895L9.219 14.2199C9.07817 14.3608 8.99905 14.5518 8.99905 14.7509C8.99905 14.9501 9.07817 15.1411 9.219 15.2819C9.35983 15.4228 9.55084 15.5019 9.75 15.5019C9.94916 15.5019 10.1402 15.4228 10.281 15.2819L17.031 8.53195C17.1008 8.46228 17.1563 8.37951 17.1941 8.2884C17.2319 8.19728 17.2513 8.0996 17.2513 8.00095C17.2513 7.9023 17.2319 7.80462 17.1941 7.7135C17.1563 7.62238 17.1008 7.53962 17.031 7.46995L10.281 0.719947C10.1402 0.579117 9.94916 0.5 9.75 0.5C9.55084 0.5 9.35983 0.579117 9.219 0.719947C9.07817 0.860777 8.99905 1.05178 8.99905 1.25095C8.99905 1.45011 9.07817 1.64112 9.219 1.78195L14.6895 7.25095Z" fill="currentColor"/>
                                                        </svg>
                                                        <span class="visually-hidden">Lire cet article</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            {{-- Retour aux articles --}}
                            <div class="sidebar-widget radius18" data-aos="fade-up">
                                <a href="{{ route('front.articles.index') }}" class="button button--secondary w-100 justify-content-center">
                                    <span class="svg-wrapper" style="transform:rotate(180deg);">
                                        <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    Tous les articles
                                </a>
                            </div>

                        </aside>
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var el = document.querySelector('.article-images-swiper');
    if (!el || typeof Swiper === 'undefined') return;
    new Swiper('.article-images-swiper', {
        loop: true,
        slidesPerView: 1,
        effect: 'fade',
        fadeEffect: { crossFade: true },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        speed: 800,
        pagination: {
            el: '.article-images-swiper .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.article-images-swiper .swiper-button-next',
            prevEl: '.article-images-swiper .swiper-button-prev',
        },
    });
});
</script>
@endpush
