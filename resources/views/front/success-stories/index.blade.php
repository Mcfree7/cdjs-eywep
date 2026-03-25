@extends('front.layouts.app')

@section('title', 'Temoignages - ' . ($settings->company_name ?? 'Front office'))

@section('content')
    <section class="pb-20 pt-12 sm:pt-16">
        <div class="fo-shell">
            <div class="max-w-3xl space-y-4">
                <span class="fo-kicker">Temoignages</span>
                <h1 class="fo-section-title">Les success stories de ton backoffice deviennent des recits publics inspirants.</h1>
                <p class="fo-section-copy">Cette section met en avant les retours d’experience et les reussites avec un traitement plus editorial et tres lisible.</p>
            </div>

            <div class="fo-grid mt-10">
                @foreach ($successStories as $story)
                    <a href="{{ route('front.success-stories.show', $story) }}" class="fo-card block">
                        @if ($story->coverImage)
                            <img src="{{ Storage::url($story->coverImage->image_path) }}" alt="{{ $story->titre }}" class="h-64 w-full rounded-[1.5rem] object-cover">
                        @endif
                        <p class="mt-5 text-sm text-slate-400">{{ optional($story->datePublication)->format('d/m/Y') }}</p>
                        <h2 class="mt-2 text-2xl font-semibold">{{ $story->titre }}</h2>
                        <p class="mt-4 text-sm leading-7 text-slate-600">{{ Str::limit(strip_tags($story->description), 180) }}</p>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $successStories->links() }}
            </div>
        </div>
    </section>
@endsection
