@extends('front.layouts.app')

@section('title', $article->titre . ' - ' . ($settings->company_name ?? 'Front office'))

@section('content')
    <section class="pb-20 pt-12 sm:pt-16">
        <div class="fo-shell">
            <a href="{{ route('front.articles.index') }}" class="fo-button-secondary">Retour aux articles</a>

            <div class="mt-8 grid gap-10 xl:grid-cols-[1.15fr_0.85fr]">
                <article class="fo-glass overflow-hidden rounded-[2.25rem]">
                    @if ($article->coverImage)
                        <img src="{{ Storage::url($article->coverImage->image_path) }}" alt="{{ $article->titre }}" class="h-[24rem] w-full object-cover sm:h-[32rem]">
                    @endif
                    <div class="p-6 sm:p-10">
                        <p class="fo-kicker">{{ optional($article->datePublication)->format('d/m/Y') }}</p>
                        <h1 class="mt-4 text-4xl font-semibold leading-tight sm:text-5xl">{{ $article->titre }}</h1>
                        <div class="prose prose-slate mt-8 max-w-none text-slate-700">
                            {!! nl2br(e($article->description)) !!}
                        </div>
                    </div>
                </article>

                <aside class="space-y-6">
                    @if ($article->images->count() > 1)
                        <div class="fo-glass rounded-[2.25rem] p-6">
                            <h2 class="text-2xl font-semibold">Galerie</h2>
                            <div class="mt-6 grid grid-cols-2 gap-4">
                                @foreach ($article->images as $image)
                                    <img src="{{ Storage::url($image->image_path) }}" alt="{{ $article->titre }}" class="h-36 w-full rounded-[1.25rem] object-cover">
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($relatedArticles->isNotEmpty())
                        <div class="fo-glass rounded-[2.25rem] p-6">
                            <h2 class="text-2xl font-semibold">Autres articles</h2>
                            <div class="mt-6 space-y-4">
                                @foreach ($relatedArticles as $related)
                                    <a href="{{ route('front.articles.show', $related) }}" class="block rounded-[1.5rem] bg-white/80 p-4">
                                        <p class="text-sm text-slate-400">{{ optional($related->datePublication)->format('d/m/Y') }}</p>
                                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $related->titre }}</p>
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
