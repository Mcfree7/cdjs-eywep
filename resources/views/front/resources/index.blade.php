@extends('front.layouts.app')

@section('title', 'Ressources - ' . ($settings->company_name ?? 'Front office'))

@section('content')
    <section class="pb-20 pt-12 sm:pt-16">
        <div class="fo-shell">
            <div class="max-w-3xl space-y-4">
                <span class="fo-kicker">Ressources</span>
                <h1 class="fo-section-title">Toutes les ressources telechargeables disponibles au public.</h1>
                <p class="fo-section-copy">Rapports, guides, documents de projet et publications sont organises dans un catalogue propre et facile a consulter.</p>
            </div>

            <div class="fo-grid mt-10">
                @foreach ($resources as $resource)
                    <div class="fo-card">
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-400">{{ $resource->categorie }}</p>
                        <h2 class="mt-3 text-2xl font-semibold">{{ $resource->titre }}</h2>
                        <p class="mt-3 text-sm text-slate-500">{{ $resource->file_name }} · {{ strtoupper($resource->file_type) }}</p>
                        <p class="mt-4 text-sm leading-7 text-slate-600">{{ Str::limit(strip_tags($resource->description ?? 'Document disponible en telechargement.'), 150) }}</p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('front.resources.show', $resource) }}" class="fo-button-secondary">Voir la fiche</a>
                            <a href="{{ route('front.resources.download', $resource) }}" class="fo-button">Telecharger</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $resources->links() }}
            </div>
        </div>
    </section>
@endsection
