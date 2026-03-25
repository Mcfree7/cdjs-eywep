@extends('front.layouts.app')

@section('title', 'Activites - ' . ($settings->company_name ?? 'Front office'))

@section('content')
    <section class="pb-20 pt-12 sm:pt-16">
        <div class="fo-shell">
            <div class="max-w-3xl space-y-4">
                <span class="fo-kicker">Activites</span>
                <h1 class="fo-section-title">Les actions de terrain rendues visibles sur le front office.</h1>
                <p class="fo-section-copy">Le contenu saisi dans l’administration se transforme ici en un parcours public clair, visuel et responsive.</p>
            </div>

            <div class="mt-10 space-y-6">
                @foreach ($activities as $activity)
                    <a href="{{ route('front.activities.show', $activity) }}" class="fo-card grid gap-6 lg:grid-cols-[18rem_1fr]">
                        @if ($activity->coverImage)
                            <img src="{{ Storage::url($activity->coverImage->image_path) }}" alt="{{ $activity->titre }}" class="h-64 w-full rounded-[1.5rem] object-cover lg:h-full">
                        @endif
                        <div class="flex flex-col justify-center">
                            <p class="text-sm text-slate-400">{{ optional($activity->datePublication)->format('d/m/Y') }}</p>
                            <h2 class="mt-3 text-3xl font-semibold">{{ $activity->titre }}</h2>
                            <p class="mt-4 text-sm leading-7 text-slate-600">{{ Str::limit(strip_tags($activity->description), 220) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $activities->links() }}
            </div>
        </div>
    </section>
@endsection
