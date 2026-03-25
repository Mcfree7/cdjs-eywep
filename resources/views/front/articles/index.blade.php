@extends('front.layouts.app')

@section('title', 'Articles - ' . ($settings->company_name ?? 'Front office'))

@section('content')
    <section class="pb-20 pt-12 sm:pt-16">
        <div class="fo-shell">
            <div class="max-w-3xl space-y-4">
                <span class="fo-kicker">Articles</span>
                <h1 class="fo-section-title">Tous les articles publies depuis le backoffice.</h1>
                <p class="fo-section-copy">Chaque publication reprend son image de couverture, sa date et son contenu detaille pour offrir une vraie lecture publique.</p>
            </div>

            <div class="fo-grid mt-10">
                @foreach ($articles as $article)
                    <a href="{{ route('front.articles.show', $article) }}" class="fo-card block">
                        @if ($article->coverImage)
                            <img src="{{ Storage::url($article->coverImage->image_path) }}" alt="{{ $article->titre }}" class="h-64 w-full rounded-[1.5rem] object-cover">
                        @endif
                        <p class="mt-5 text-sm text-slate-400">{{ optional($article->datePublication)->format('d/m/Y') }}</p>
                        <h2 class="mt-2 text-2xl font-semibold">{{ $article->titre }}</h2>
                        <p class="mt-4 text-sm leading-7 text-slate-600">{{ Str::limit(strip_tags($article->description), 170) }}</p>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $articles->links() }}
            </div>
        </div>
    </section>
@endsection
