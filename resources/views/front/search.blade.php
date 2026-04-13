@extends('front.layouts.app')

@section('title', 'Recherche' . ($q ? ' : ' . $q : '') . ' — ' . ($settings->company_name ?? 'EYWEP'))

@section('content')
<main>

    @include('front.partials.page-banner', [
        'bannerTitle'      => 'Résultats de recherche',
        'breadcrumbParent' => null,
    ])

    <section class="section-padding mt-60">
        <div class="container">

            {{-- Barre de recherche --}}
            <form action="{{ route('front.search') }}" method="GET" class="d-flex gap-3 mb-5" role="search">
                <input
                    type="search"
                    name="q"
                    value="{{ $q }}"
                    placeholder="Rechercher..."
                    class="form-control radius18"
                    style="max-width: 520px; font-size: 16px; padding: 12px 20px;"
                    autofocus
                    autocomplete="off"
                >
                <button type="submit" class="button button--primary" aria-label="Lancer la recherche">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42-1.39zM11 18a7 7 0 1 1 7-7 7 7 0 0 1-7 7z" fill="currentColor"/>
                    </svg>
                </button>
            </form>

            @if(mb_strlen($q) < 2)
                <p class="text text-18 text-muted">Entrez au moins 2 caractères pour lancer une recherche.</p>

            @elseif($results->isEmpty())
                <div class="text-center py-5">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" style="color:#ccc; margin-bottom:16px;">
                        <path d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42-1.39zM11 18a7 7 0 1 1 7-7 7 7 0 0 1-7 7z" fill="currentColor"/>
                    </svg>
                    <h2 class="heading text-28 fw-700 mb-2">Aucun résultat</h2>
                    <p class="text text-18 text-muted">Aucun contenu ne correspond à <strong>« {{ $q }} »</strong>.</p>
                </div>

            @else
                <p class="text text-16 text-muted mb-4">
                    <strong>{{ $results->count() }}</strong> résultat{{ $results->count() > 1 ? 's' : '' }} pour <strong>« {{ $q }} »</strong>
                </p>

                <div class="row g-4">
                    @foreach($results as $item)
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ $item['url'] }}" class="d-block text-decoration-none h-100">
                            <div class="radius18 p-4 h-100" style="border: 1px solid rgba(0,0,0,0.08); background:#fff; transition: box-shadow .2s, transform .2s;">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span class="badge" style="font-size:11px; background: var(--clr-primary, #1a1a2e); color:#fff; padding: 4px 10px; border-radius: 999px;">
                                        {{ $item['type'] }}
                                    </span>
                                    @if($item['date'])
                                        <span class="text text-13 text-muted">{{ $item['date'] }}</span>
                                    @endif
                                </div>
                                <h3 class="heading text-18 fw-700 mb-2" style="color: var(--color-heading, #1c2539);">
                                    {{ $item['titre'] }}
                                </h3>
                                @if($item['extrait'])
                                    <p class="text text-14 text-muted mb-0">{{ $item['extrait'] }}</p>
                                @endif
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

</main>
@endsection

@push('styles')
<style>
.col-12 a:hover > div {
    box-shadow: 0 8px 32px rgba(0,0,0,0.10);
    transform: translateY(-3px);
}
</style>
@endpush