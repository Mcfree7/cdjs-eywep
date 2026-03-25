@extends('front.layouts.app')

@section('title', 'Galeries - ' . ($settings->company_name ?? 'Front office'))

@section('content')
    <section class="pb-20 pt-12 sm:pt-16">
        <div class="fo-shell">
            <div class="max-w-3xl space-y-4">
                <span class="fo-kicker">Galeries</span>
                <h1 class="fo-section-title">Les albums photo et video du backoffice, presentes dans une galerie publique elegante.</h1>
                <p class="fo-section-copy">Cette page valorise tes medias avec des apercus immersifs et des pages dediees par galerie.</p>
            </div>

            <div class="fo-grid mt-10">
                @foreach ($galleries as $gallery)
                    @php
                        $coverMedia = $gallery->medias->first();
                    @endphp
                    <a href="{{ route('front.galleries.show', $gallery) }}" class="fo-card block">
                        @if ($coverMedia)
                            @if ($coverMedia->media_type === 'video')
                                <video src="{{ Storage::url($coverMedia->media_path) }}" muted class="h-64 w-full rounded-[1.5rem] object-cover"></video>
                            @else
                                <img src="{{ Storage::url($coverMedia->media_path) }}" alt="{{ $gallery->titre }}" class="h-64 w-full rounded-[1.5rem] object-cover">
                            @endif
                        @else
                            <div class="h-64 rounded-[1.5rem] bg-slate-200"></div>
                        @endif
                        <h2 class="mt-5 text-2xl font-semibold">{{ $gallery->titre }}</h2>
                        <p class="mt-3 text-sm text-slate-500">{{ $gallery->medias->count() }} media(s)</p>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $galleries->links() }}
            </div>
        </div>
    </section>
@endsection
