@extends('front.layouts.app')

@section('title', $activity->titre . ' - ' . ($settings->company_name ?? 'Front office'))

@section('content')
    <section class="pb-20 pt-12 sm:pt-16">
        <div class="fo-shell">
            <a href="{{ route('front.activities.index') }}" class="fo-button-secondary">Retour aux activites</a>

            <div class="mt-8 grid gap-10 xl:grid-cols-[1.15fr_0.85fr]">
                <article class="fo-glass overflow-hidden rounded-[2.25rem]">
                    @if ($activity->coverImage)
                        <img src="{{ Storage::url($activity->coverImage->image_path) }}" alt="{{ $activity->titre }}" class="h-[24rem] w-full object-cover sm:h-[32rem]">
                    @endif
                    <div class="p-6 sm:p-10">
                        <p class="fo-kicker">{{ optional($activity->datePublication)->format('d/m/Y') }}</p>
                        <h1 class="mt-4 text-4xl font-semibold leading-tight sm:text-5xl">{{ $activity->titre }}</h1>
                        <div class="prose prose-slate mt-8 max-w-none text-slate-700">
                            {!! nl2br(e($activity->description)) !!}
                        </div>
                    </div>
                </article>

                <aside class="space-y-6">
                    @if ($activity->images->isNotEmpty())
                        <div class="fo-glass rounded-[2.25rem] p-6">
                            <h2 class="text-2xl font-semibold">Photos de l'activite</h2>
                            <div class="mt-6 grid grid-cols-2 gap-4">
                                @foreach ($activity->images as $image)
                                    <img src="{{ Storage::url($image->image_path) }}" alt="{{ $activity->titre }}" class="h-36 w-full rounded-[1.25rem] object-cover">
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($relatedActivities->isNotEmpty())
                        <div class="fo-glass rounded-[2.25rem] p-6">
                            <h2 class="text-2xl font-semibold">Autres activites</h2>
                            <div class="mt-6 space-y-4">
                                @foreach ($relatedActivities as $related)
                                    <a href="{{ route('front.activities.show', $related) }}" class="block rounded-[1.5rem] bg-white/80 p-4">
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
