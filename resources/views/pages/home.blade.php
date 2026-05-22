@extends('layouts.app')
@section('title', __('site.nav.home'))

@section('content')
{{-- Hero Section --}}
<section class="relative min-h-screen flex items-center justify-center bg-dark overflow-hidden">
    @php $heroImage = \App\Models\SiteSetting::get('hero_image'); @endphp
    @if($heroImage)
    <img src="{{ asset('storage/' . $heroImage) }}" alt="NDPCC" class="absolute inset-0 w-full h-full object-cover">
    @endif
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/90 via-dark/80 to-dark"></div>
    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
        <span class="inline-block px-4 py-2 bg-gold/20 text-gold text-sm font-semibold rounded-full mb-6 animate-fade-in">
            {{ __('site.home.badge') }}
        </span>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white leading-tight mb-6 animate-fade-in-delay-1">
            {{ __('site.home.hero_title') }}
        </h1>
        <p class="text-lg md:text-xl text-white/80 mb-10 animate-fade-in-delay-2">
            {{ __('site.home.hero_text') }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-delay-3">
            <a href="{{ route('contact', $locale ?? 'en') }}" class="px-8 py-4 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition shadow-lg">
                {{ __('site.home.btn_join') }}
            </a>
            <a href="{{ route('sermons', $locale ?? 'en') }}" class="px-8 py-4 border-2 border-gold text-gold font-semibold rounded-lg hover:bg-gold hover:text-white transition">
                {{ __('site.home.btn_sermons') }}
            </a>
        </div>
    </div>
</section>

{{-- Service Times Bar --}}
<section class="bg-primary py-4">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-center gap-4 md:gap-8 text-white text-sm font-medium">
        <span>🕐 {{ __('site.home.service_sunday') }}</span>
        <span class="hidden md:inline">•</span>
        <span>🙏 {{ __('site.home.service_wednesday') }}</span>
        <span class="hidden md:inline">•</span>
        <span>📖 {{ __('site.home.service_friday') }}</span>
    </div>
</section>

{{-- Stats Section --}}
<section class="py-16 bg-gray-soft" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div>
            <div class="text-4xl font-bold text-primary" data-counter="30">0+</div>
            <p class="text-gray-600 mt-2 text-sm">{{ __('site.home.stats_years') }}</p>
        </div>
        <div>
            <div class="text-4xl font-bold text-primary" data-counter="500">0+</div>
            <p class="text-gray-600 mt-2 text-sm">{{ __('site.home.stats_families') }}</p>
        </div>
        <div>
            <div class="text-4xl font-bold text-primary" data-counter="200">0+</div>
            <p class="text-gray-600 mt-2 text-sm">{{ __('site.home.stats_children') }}</p>
        </div>
        <div>
            <div class="text-4xl font-bold text-primary" data-counter="5">0+</div>
            <p class="text-gray-600 mt-2 text-sm">{{ __('site.home.stats_branches') }}</p>
        </div>
    </div>
</section>

{{-- Scripture of the Week --}}
@if($scripture)
<section class="py-16 bg-gradient-to-r from-primary-dark to-primary text-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ __('site.home.scripture_label') }}</span>
        <blockquote class="mt-6 text-2xl md:text-3xl font-serif italic leading-relaxed">
            {{ app()->getLocale() === 'sw' ? $scripture->verse_sw : $scripture->verse_en }}
        </blockquote>
        <p class="mt-4 text-gold font-semibold">— {{ $scripture->reference }}</p>
    </div>
</section>
@endif

{{-- YouTube Live Widget --}}
@php
    $ytIsLive = \App\Models\SiteSetting::get('youtube_is_live') === '1';
    $ytLiveVideoId = \App\Models\SiteSetting::get('youtube_live_video_id');
@endphp
@if($ytIsLive && $ytLiveVideoId)
<section class="py-6 bg-red-600" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <span class="relative flex h-4 w-4">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-white"></span>
            </span>
            <div class="text-white">
                <strong class="text-lg">{{ __('site.live_now') }}</strong>
                <p class="text-white/80 text-sm">{{ __('site.sunday_service_live') }}</p>
            </div>
        </div>
        <a href="{{ route('sermons', ['locale' => app()->getLocale()]) }}#live"
           class="px-6 py-3 bg-gold text-white font-semibold rounded-lg hover:bg-gold/90 transition shadow-lg whitespace-nowrap">
            {{ __('site.watch_live') }}
        </a>
    </div>
</section>
@endif

{{-- Mission Cards --}}
<section class="py-20 bg-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ __('site.home.mission_label') }}</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Teaching --}}
            <div class="bg-white border-l-4 border-primary p-8 rounded-lg shadow-md hover:-translate-y-1 transition-transform">
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="text-xl font-bold text-primary mb-2">{{ __('site.home.mission_teaching_title') }}</h3>
                <p class="text-gray-600">{{ __('site.home.mission_teaching_text') }}</p>
            </div>
            {{-- Outreach --}}
            <div class="bg-white border-l-4 border-gold p-8 rounded-lg shadow-md hover:-translate-y-1 transition-transform">
                <div class="w-12 h-12 bg-gold/10 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gold mb-2">{{ __('site.home.mission_outreach_title') }}</h3>
                <p class="text-gray-600">{{ __('site.home.mission_outreach_text') }}</p>
            </div>
            {{-- Serving --}}
            <div class="bg-white border-l-4 border-primary p-8 rounded-lg shadow-md hover:-translate-y-1 transition-transform">
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-primary mb-2">{{ __('site.home.mission_serving_title') }}</h3>
                <p class="text-gray-600">{{ __('site.home.mission_serving_text') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
