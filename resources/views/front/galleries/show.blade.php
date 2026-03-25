@extends('front.layouts.app')

@section('title', $gallery->titre . ' - ' . ($settings->company_name ?? 'Front office'))

@section('content')
    <section class="pb-20 pt-12 sm:pt-16">
        <div class="fo-shell">
            <a href="{{ route('front.galleries.index') }}" class="fo-button-secondary">Retour aux galeries</a>

            <div class="mt-8 grid gap-10 xl:grid-cols-[1.1fr_0.9fr]">
                <div class="fo-glass rounded-[2.25rem] p-6 sm:p-8">
                    <p class="fo-kicker">Galerie</p>
                    <h1 class="mt-4 text-4xl font-semibold sm:text-5xl">{{ $gallery->titre }}</h1>
                    <p class="mt-4 text-base leading-8 text-slate-600">{{ $gallery->medias->count() }} media(s) disponibles dans cette galerie.</p>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2">
                        @foreach ($gallery->medias as $media)
                            <div class="overflow-hidden rounded-[1.5rem] bg-slate-950">
                                @if ($media->media_type === 'video')
                                    <video controls class="h-64 w-full object-cover">
                                        <source src="{{ Storage::url($media->media_path) }}">
                                    </video>
                                @else
                                    <img src="{{ Storage::url($media->media_path) }}" alt="{{ $gallery->titre }}" class="h-64 w-full object-cover">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                @if ($otherGalleries->isNotEmpty())
                    <aside class="fo-glass rounded-[2.25rem] p-6">
                        <h2 class="text-2xl font-semibold">Autres galeries</h2>
                        <div class="mt-6 space-y-4">
                            @foreach ($otherGalleries as $other)
                                @php
                                    $coverMedia = $other->medias->first();
                                @endphp
                                <a href="{{ route('front.galleries.show', $other) }}" class="block rounded-[1.5rem] bg-white/80 p-4">
                                    @if ($coverMedia && $coverMedia->media_type === 'image')
                                        <img src="{{ Storage::url($coverMedia->media_path) }}" alt="{{ $other->titre }}" class="mb-4 h-32 w-full rounded-[1rem] object-cover">
                                    @endif
                                    <p class="text-lg font-semibold text-slate-900">{{ $other->titre }}</p>
                                    <p class="mt-2 text-sm text-slate-500">{{ $other->medias->count() }} media(s)</p>
                                </a>
                            @endforeach
                        </div>
                    </aside>
                @endif
            </div>
        </div>
    </section>
@endsection
