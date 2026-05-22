@extends('layouts.app')
@section('title', __('site.nav.home'))

@section('content')
{{-- Hero Section --}}
<section class="relative min-h-screen flex items-center justify-center bg-dark overflow-hidden">
    @php
        $heroImage = \App\Models\SiteSetting::get('hero_image');
        $heroVideo = \App\Models\SiteSetting::get('hero_video_url');
    @endphp
    @if($heroVideo)
        @php preg_match('/(?:v=|youtu\.be\/|embed\/)([a-zA-Z0-9_-]{11})/', $heroVideo, $hvm); $heroVideoId = $hvm[1] ?? null; @endphp
        @if($heroVideoId)
        <iframe src="https://www.youtube.com/embed/{{ $heroVideoId }}?autoplay=1&mute=1&loop=1&playlist={{ $heroVideoId }}&controls=0&showinfo=0&rel=0"
                class="absolute inset-0 w-full h-full pointer-events-none" style="min-width: 100%; min-height: 100%; transform: scale(1.3);"
                frameborder="0" allow="autoplay" allowfullscreen></iframe>
        @endif
    @elseif($heroImage)
    <img src="{{ asset('storage/' . $heroImage) }}" alt="NDPCC" class="absolute inset-0 w-full h-full object-cover">
    @endif
    <div class="absolute inset-0 bg-gradient-to-b from-dark/70 via-dark/60 to-dark/90"></div>
    <div class="relative z-10 text-center px-4 max-w-5xl mx-auto">
        <span class="inline-block px-5 py-2.5 bg-gold/20 text-gold text-sm font-semibold rounded-full mb-8 backdrop-blur-sm border border-gold/30" data-aos="fade-up">
            {{ __('site.home.badge') }}
        </span>
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold text-white leading-[1.1] mb-8" data-aos="fade-up" data-aos-delay="100">
            {{ __('site.home.hero_title') }}
        </h1>
        <p class="text-lg md:text-2xl text-white/80 mb-12 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            {{ __('site.home.hero_text') }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="300">
            <a href="{{ route('contact', $locale ?? 'en') }}" class="px-10 py-4 bg-gold text-white font-bold rounded-xl hover:bg-gold-light transition shadow-xl text-lg">
                {{ __('site.home.btn_join') }}
            </a>
            <a href="{{ route('sermons', $locale ?? 'en') }}" class="px-10 py-4 border-2 border-white/50 text-white font-bold rounded-xl hover:bg-white hover:text-primary transition backdrop-blur-sm text-lg">
                {{ __('site.home.btn_sermons') }}
            </a>
        </div>
    </div>
    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </div>
</section>

{{-- Service Times Bar --}}
<section class="bg-primary py-5">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-center gap-6 md:gap-10 text-white font-medium">
        <span class="flex items-center gap-2"><svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> {{ __('site.home.service_sunday') }}</span>
        <span class="hidden md:inline text-white/30">|</span>
        <span class="flex items-center gap-2"><svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg> {{ __('site.home.service_wednesday') }}</span>
        <span class="hidden md:inline text-white/30">|</span>
        <span class="flex items-center gap-2"><svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/></svg> {{ __('site.home.service_friday') }}</span>
    </div>
</section>

{{-- YouTube Live Widget --}}
@php $ytIsLive = \App\Models\SiteSetting::get('youtube_is_live') === '1'; $ytLiveVideoId = \App\Models\SiteSetting::get('youtube_live_video_id'); @endphp
@if($ytIsLive && $ytLiveVideoId)
<section class="py-5 bg-red-600" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <span class="relative flex h-4 w-4"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span><span class="relative inline-flex rounded-full h-4 w-4 bg-white"></span></span>
            <div class="text-white"><strong class="text-lg">{{ __('site.live_now') }}</strong><p class="text-white/80 text-sm">{{ __('site.sunday_service_live') }}</p></div>
        </div>
        <a href="{{ route('sermons', ['locale' => app()->getLocale()]) }}#live" class="px-6 py-3 bg-gold text-white font-semibold rounded-lg hover:bg-gold/90 transition shadow-lg">{{ __('site.watch_live') }}</a>
    </div>
</section>
@endif

{{-- Stats Section --}}
<section class="py-20 bg-gray-soft">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div data-aos="fade-up">
            <div class="text-5xl font-bold text-primary" data-counter="30">0+</div>
            <p class="text-gray-600 mt-3 font-medium">{{ __('site.home.stats_years') }}</p>
        </div>
        <div data-aos="fade-up" data-aos-delay="100">
            <div class="text-5xl font-bold text-primary" data-counter="500">0+</div>
            <p class="text-gray-600 mt-3 font-medium">{{ __('site.home.stats_families') }}</p>
        </div>
        <div data-aos="fade-up" data-aos-delay="200">
            <div class="text-5xl font-bold text-primary" data-counter="200">0+</div>
            <p class="text-gray-600 mt-3 font-medium">{{ __('site.home.stats_children') }}</p>
        </div>
        <div data-aos="fade-up" data-aos-delay="300">
            <div class="text-5xl font-bold text-primary" data-counter="5">0+</div>
            <p class="text-gray-600 mt-3 font-medium">{{ __('site.home.stats_branches') }}</p>
        </div>
    </div>
</section>

{{-- Scripture of the Week --}}
@if($scripture)
<section class="py-20 bg-gradient-to-r from-primary-dark to-primary text-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ __('site.home.scripture_label') }}</span>
        <blockquote class="mt-8 text-2xl md:text-4xl font-serif italic leading-relaxed">
            {{ app()->getLocale() === 'sw' ? $scripture->verse_sw : $scripture->verse_en }}
        </blockquote>
        <p class="mt-6 text-gold font-semibold text-lg">— {{ $scripture->reference }}</p>
    </div>
</section>
@endif

{{-- Mission Cards --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ __('site.home.mission_label') }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">{{ app()->getLocale() === 'sw' ? 'Tunachofanya' : 'What We Do' }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:-translate-y-2 transition-all duration-300" data-aos="fade-up">
                <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('site.home.mission_teaching_title') }}</h3>
                <p class="text-gray-600 leading-relaxed">{{ __('site.home.mission_teaching_text') }}</p>
                <a href="{{ route('sermons', $locale ?? 'en') }}" class="inline-flex items-center gap-1 mt-5 text-primary font-semibold text-sm hover:gap-2 transition-all">{{ app()->getLocale() === 'sw' ? 'Tazama Mahubiri' : 'Watch Sermons' }} <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                <div class="w-14 h-14 bg-gold/10 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('site.home.mission_outreach_title') }}</h3>
                <p class="text-gray-600 leading-relaxed">{{ __('site.home.mission_outreach_text') }}</p>
                <a href="{{ route('foundation', $locale ?? 'en') }}" class="inline-flex items-center gap-1 mt-5 text-gold font-semibold text-sm hover:gap-2 transition-all">{{ app()->getLocale() === 'sw' ? 'Foundation' : 'Our Foundation' }} <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('site.home.mission_serving_title') }}</h3>
                <p class="text-gray-600 leading-relaxed">{{ __('site.home.mission_serving_text') }}</p>
                <a href="{{ route('ministries', $locale ?? 'en') }}" class="inline-flex items-center gap-1 mt-5 text-primary font-semibold text-sm hover:gap-2 transition-all">{{ app()->getLocale() === 'sw' ? 'Huduma Zetu' : 'Our Ministries' }} <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
            </div>
        </div>
    </div>
</section>

{{-- Latest Sermons --}}
@if(isset($latestSermons) && $latestSermons->count())
<section class="py-20 bg-gray-soft">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between mb-12" data-aos="fade-up">
            <div>
                <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Mahubiri Mapya' : 'Latest Sermons' }}</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2">{{ app()->getLocale() === 'sw' ? 'Tazama na Usikie' : 'Watch & Listen' }}</h2>
            </div>
            <a href="{{ route('sermons', $locale ?? 'en') }}" class="hidden md:inline-flex items-center gap-2 px-5 py-2.5 border-2 border-primary text-primary font-semibold rounded-lg hover:bg-primary hover:text-white transition">
                {{ app()->getLocale() === 'sw' ? 'Tazama Zote' : 'View All' }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestSermons as $sermon)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="relative h-48 bg-gray-200 overflow-hidden group">
                    @if($sermon->thumbnail_url)
                    <img src="{{ $sermon->thumbnail_url }}" alt="{{ app()->getLocale() === 'sw' ? $sermon->title_sw : $sermon->title_en }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-primary to-primary-dark"></div>
                    @endif
                    @if($sermon->youtube_video_id)
                    <a href="https://www.youtube.com/embed/{{ $sermon->youtube_video_id }}" class="glightbox absolute inset-0 flex items-center justify-center bg-black/0 group-hover:bg-black/40 transition-all">
                        <div class="w-14 h-14 bg-white/90 rounded-full flex items-center justify-center shadow-xl opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg class="w-6 h-6 text-primary ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </a>
                    @endif
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 line-clamp-2 mb-2">{{ app()->getLocale() === 'sw' ? $sermon->title_sw : $sermon->title_en }}</h3>
                    <p class="text-sm text-gray-500">{{ $sermon->preached_at?->format('M d, Y') }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8 md:hidden">
            <a href="{{ route('sermons', $locale ?? 'en') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-semibold rounded-lg">{{ app()->getLocale() === 'sw' ? 'Tazama Zote' : 'View All Sermons' }}</a>
        </div>
    </div>
</section>
@endif

{{-- Upcoming Events --}}
@if($upcomingEvents->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between mb-12" data-aos="fade-up">
            <div>
                <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Matukio' : 'Events' }}</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2">{{ app()->getLocale() === 'sw' ? 'Matukio Yanayokuja' : 'Upcoming Events' }}</h2>
            </div>
            <a href="{{ route('events', $locale ?? 'en') }}" class="hidden md:inline-flex items-center gap-2 px-5 py-2.5 border-2 border-gold text-gold font-semibold rounded-lg hover:bg-gold hover:text-white transition">
                {{ app()->getLocale() === 'sw' ? 'Tazama Zote' : 'View All' }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($upcomingEvents as $event)
            <div class="bg-gray-soft rounded-2xl overflow-hidden hover:-translate-y-1 transition-all duration-300 border border-gray-100" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                @if($event->featured_image)
                <img src="{{ asset('storage/' . $event->featured_image) }}" alt="" class="w-full h-44 object-cover">
                @else
                <div class="w-full h-44 bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                    <div class="text-center text-white"><div class="text-3xl font-bold">{{ $event->starts_at->format('d') }}</div><div class="text-sm uppercase">{{ $event->starts_at->format('M') }}</div></div>
                </div>
                @endif
                <div class="p-6">
                    <span class="text-xs text-gold font-bold uppercase">{{ $event->starts_at->format('M d, Y — H:i') }}</span>
                    <h3 class="text-lg font-bold text-gray-900 mt-2 mb-2">{{ app()->getLocale() === 'sw' ? $event->title_sw : $event->title_en }}</h3>
                    @if($event->location)<p class="text-sm text-gray-500 mb-3">📍 {{ $event->location }}</p>@endif
                    @if($event->button_url)
                    <a href="{{ $event->button_url }}" target="_blank" class="inline-flex items-center text-sm text-primary font-semibold hover:gap-2 gap-1 transition-all">{{ $event->button_text ?? 'Join' }} <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Give CTA --}}
<section class="py-20 bg-gradient-to-r from-primary-dark to-primary text-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ app()->getLocale() === 'sw' ? 'Toa Sadaka Yako' : 'Give an Offering' }}</h2>
        <p class="text-white/70 text-lg mb-8 max-w-xl mx-auto">{{ app()->getLocale() === 'sw' ? 'Sadaka yako inasaidia kueneza Injili na kubadilisha maisha ya watu wengi.' : 'Your offering helps spread the Gospel and transform many lives.' }}</p>
        <a href="{{ route('give', $locale ?? 'en') }}" class="inline-flex items-center gap-3 px-10 py-5 bg-gold text-white font-bold rounded-xl hover:bg-gold-light transition shadow-xl text-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ app()->getLocale() === 'sw' ? 'Toa Sadaka Sasa' : 'Give Now' }}
        </a>
    </div>
</section>
@endsection
