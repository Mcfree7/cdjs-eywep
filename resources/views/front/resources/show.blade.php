@extends('front.layouts.app')

@section('title', $resourceItem->titre . ' - ' . ($settings->company_name ?? 'Front office'))

@section('content')
    <section class="pb-20 pt-12 sm:pt-16">
        <div class="fo-shell">
            <a href="{{ route('front.resources.index') }}" class="fo-button-secondary">Retour aux ressources</a>

            <div class="mt-8 grid gap-10 xl:grid-cols-[1.1fr_0.9fr]">
                <article class="fo-glass rounded-[2.25rem] p-6 sm:p-10">
                    <p class="fo-kicker">{{ $resourceItem->categorie }}</p>
                    <h1 class="mt-4 text-4xl font-semibold leading-tight sm:text-5xl">{{ $resourceItem->titre }}</h1>
                    <div class="mt-6 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-[1.25rem] bg-white/80 p-4">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Format</p>
                            <p class="mt-2 font-semibold text-slate-900">{{ strtoupper($resourceItem->file_type) }}</p>
                        </div>
                        <div class="rounded-[1.25rem] bg-white/80 p-4">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Fichier</p>
                            <p class="mt-2 font-semibold text-slate-900">{{ $resourceItem->file_name }}</p>
                        </div>
                        <div class="rounded-[1.25rem] bg-white/80 p-4">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Publication</p>
                            <p class="mt-2 font-semibold text-slate-900">{{ optional($resourceItem->datePublication)->format('d/m/Y') ?: 'Non renseignee' }}</p>
                        </div>
                    </div>

                    <div class="mt-8 text-base leading-8 text-slate-700">
                        {!! nl2br(e($resourceItem->description ?? 'Cette ressource est disponible en consultation et telechargement depuis le front office.')) !!}
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('front.resources.download', $resourceItem) }}" class="fo-button">Telecharger la ressource</a>
                    </div>
                </article>

                <aside class="space-y-6">
                    @if ($relatedResources->isNotEmpty())
                        <div class="fo-glass rounded-[2.25rem] p-6">
                            <h2 class="text-2xl font-semibold">Dans la meme categorie</h2>
                            <div class="mt-6 space-y-4">
                                @foreach ($relatedResources as $related)
                                    <a href="{{ route('front.resources.show', $related) }}" class="block rounded-[1.5rem] bg-white/80 p-4">
                                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">{{ $related->categorie }}</p>
                                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $related->titre }}</p>
                                        <p class="mt-2 text-sm text-slate-500">{{ $related->file_name }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>
@endsection
