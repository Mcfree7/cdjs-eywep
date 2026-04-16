@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp
@extends('front.layouts.app')

@section('title', __('app.titles.testimonials') . ' - ' . ($settings->company_name ?? 'EYWEP'))
@section('description', 'Découvrez les témoignages et histoires de succès de ' . ($settings->company_name ?? 'EYWEP'))

@section('content')
<main>

    @include('front.partials.page-banner', ['bannerTitle' => __('app.pages.testimonials')])

    <div class="page-blog mt-150 section-padding">
        <div class="container">
            <div class="row product-grid">

                @forelse ($successStories as $story)
                <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    <div class="card-blog radius18">
                        <div class="card-blog-top">
                            <div class="card-blog-meta">
                                @if ($story->datePublication)
                                <div class="card-blog-meta-item text text-18">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.1667 10.6667C13.3877 10.6667 13.5996 10.5789 13.7559 10.4226C13.9122 10.2663 14 10.0543 14 9.83333C14 9.61232 13.9122 9.40036 13.7559 9.24408C13.5996 9.0878 13.3877 9 13.1667 9C12.9457 9 12.7337 9.0878 12.5774 9.24408C12.4211 9.40036 12.3333 9.61232 12.3333 9.83333C12.3333 10.0543 12.4211 10.2663 12.5774 10.4226C12.7337 10.5789 12.9457 10.6667 13.1667 10.6667Z" fill="currentColor"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.83268 0.453125C4.99844 0.453125 5.15741 0.518973 5.27462 0.636183C5.39183 0.753394 5.45768 0.912365 5.45768 1.07812V1.71396C6.00935 1.70312 6.61685 1.70312 7.28518 1.70312H10.7127C11.3818 1.70312 11.9893 1.70312 12.541 1.71396V1.07812C12.541 0.912365 12.6069 0.753394 12.7241 0.636183C12.8413 0.518973 13.0003 0.453125 13.166 0.453125C13.3318 0.453125 13.4907 0.518973 13.608 0.636183C13.7252 0.753394 13.791 0.912365 13.791 1.07812V1.76729C14.0077 1.78396 14.2127 1.80479 14.4068 1.83063C15.3835 1.96229 16.1743 2.23896 16.7985 2.86229C17.4218 3.48646 17.6985 4.27729 17.8302 5.25396C17.9577 6.20396 17.9577 7.41646 17.9577 8.94812V10.7081C17.9577 12.2398 17.9577 13.4531 17.8302 14.4023C17.6985 15.379 17.4218 16.1698 16.7985 16.794C16.1743 17.4173 15.3835 17.694 14.4068 17.8256C13.4568 17.9531 12.2443 17.9531 10.7127 17.9531H7.28602C5.75435 17.9531 4.54102 17.9531 3.59185 17.8256C2.61518 17.694 1.82435 17.4173 1.20018 16.794C0.576849 16.1698 0.300182 15.379 0.168516 14.4023C0.0410156 13.4523 0.0410156 12.2398 0.0410156 10.7081V8.94812C0.0410156 7.41646 0.0410156 6.20312 0.168516 5.25396C0.300182 4.27729 0.576849 3.48646 1.20018 2.86229C1.82435 2.23896 2.61518 1.96229 3.59185 1.83063C3.78602 1.80479 3.99185 1.78396 4.20768 1.76729V1.07812C4.20768 0.912365 4.27353 0.753394 4.39074 0.636183C4.50795 0.518973 4.66692 0.453125 4.83268 0.453125ZM3.75768 3.06979C2.92018 3.18229 2.43685 3.39396 2.08435 3.74646C1.73185 4.09896 1.52018 4.58229 1.40768 5.42062C1.38852 5.56229 1.37268 5.71229 1.35935 5.86979H16.6393C16.626 5.71146 16.6102 5.56229 16.591 5.41979C16.4785 4.58229 16.2668 4.09896 15.9143 3.74646C15.5618 3.39396 15.0785 3.18229 14.2402 3.06979C13.3843 2.95479 12.2552 2.95312 10.666 2.95312H7.33268C5.74352 2.95312 4.61518 2.95479 3.75768 3.06979ZM1.29102 8.99479C1.29102 8.28312 1.29102 7.66396 1.30185 7.11979H16.6968C16.7077 7.66396 16.7077 8.28312 16.7077 8.99479V10.6615C16.7077 12.2506 16.706 13.3798 16.591 14.2365C16.4785 15.074 16.2668 15.5573 15.9143 15.9098C15.5618 16.2623 15.0785 16.474 14.2402 16.5865C13.3843 16.7015 12.2552 16.7031 10.666 16.7031H7.33268C5.74352 16.7031 4.61518 16.7015 3.75768 16.5865C2.92018 16.474 2.43685 16.2623 2.08435 15.9098C1.73185 15.5573 1.52018 15.074 1.40768 14.2356C1.29268 13.3798 1.29102 12.2506 1.29102 10.6615V8.99479Z" fill="currentColor"/>
                                    </svg>
                                    {{ $story->datePublication->format('d M Y') }}
                                </div>
                                @endif
                            </div>
                            <h2 class="card-blog-heading heading text-22">
                                <a href="{{ route('front.success-stories.show', $story) }}" class="heading text-22">
                                    {{ $story->titre }}
                                </a>
                            </h2>
                        </div>
                        <a class="card-blog-bottom" href="{{ route('front.success-stories.show', $story) }}" aria-label="{{ $story->titre }}">
                            <span class="blog-tag subheading subheading-bg text-16 fw-500">Témoignage</span>
                            <div class="media">
                                <img
                                    src="{{ $story->coverImage ? Storage::url($story->coverImage->image_path) : asset('front-assets/consulo/img/blog/3.jpg') }}"
                                    alt="{{ $story->titre }}"
                                    width="1000"
                                    height="707"
                                    loading="lazy"
                                >
                            </div>
                            <div class="buttons">
                                <div class="button button--primary">
                                    Lire la suite
                                    <svg viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.16668 0.833333C2.16668 0.61232 2.25448 0.400358 2.41076 0.244078C2.56704 0.0877975 2.779 0 3.00001 0H9.66668C9.88769 0 10.0997 0.0877975 10.2559 0.244078C10.4122 0.400358 10.5 0.61232 10.5 0.833333V7.5C10.5 7.72101 10.4122 7.93297 10.2559 8.08926C10.0997 8.24554 9.88769 8.33333 9.66668 8.33333C9.44567 8.33333 9.2337 8.24554 9.07742 8.08926C8.92114 7.93297 8.83335 7.72101 8.83335 7.5V2.845L1.92251 9.75583C1.76535 9.90763 1.55484 9.99163 1.33635 9.98973C1.11785 9.98783 0.908839 9.90019 0.754332 9.74568C0.599825 9.59118 0.512184 9.38216 0.510285 9.16367C0.508387 8.94517 0.592382 8.73467 0.744181 8.5775L7.65501 1.66667H3.00001C2.779 1.66667 2.56704 1.57887 2.41076 1.42259C2.25448 1.26631 2.16668 1.05435 2.16668 0.833333Z" fill="currentColor"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <p class="text text-18" style="color: var(--color-foreground-subheading);">Aucun témoignage disponible pour le moment.</p>
                        <a href="{{ route('front.home') }}" class="button button--secondary mt-3">Retour à l'accueil</a>
                    </div>
                </div>
                @endforelse

            </div>

            @if ($successStories->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $successStories->links() }}
            </div>
            @endif

        </div>
    </div>

</main>
@endsection
