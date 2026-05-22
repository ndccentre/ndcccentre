@extends('layouts.app')
@section('title', __('site.events.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-40 bg-dark overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/90 via-dark/80 to-dark"></div>
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 right-20 w-80 h-80 bg-gold rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 left-10 w-64 h-64 bg-primary rounded-full blur-3xl"></div>
    </div>
    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-2 bg-gold/20 text-gold text-sm font-semibold rounded-full mb-6" data-aos="fade-up">
            {{ app()->getLocale() === 'sw' ? 'Matukio ya Kanisa' : 'Church Events' }}
        </span>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6" data-aos="fade-up" data-aos-delay="100">{{ __('site.events.title') }}</h1>
        <p class="text-xl text-white/70 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">{{ __('site.events.subtitle') }}</p>
    </div>
</section>

{{-- Upcoming Events Highlight --}}
@php
    $upcoming = $events->filter(fn($e) => $e->starts_at->isFuture());
    $past = $events->filter(fn($e) => $e->starts_at->isPast());
@endphp

@if($upcoming->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Yanayokuja' : 'Coming Up' }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">{{ app()->getLocale() === 'sw' ? 'Matukio Yanayokuja' : 'Upcoming Events' }}</h2>
        </div>

        {{-- Featured Event (first upcoming) --}}
        @php $featured = $upcoming->first(); @endphp
        <div class="mb-16 bg-gradient-to-r from-primary-dark to-primary rounded-3xl overflow-hidden shadow-2xl" data-aos="fade-up">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                @if($featured->featured_image)
                <img src="{{ asset('storage/' . $featured->featured_image) }}" alt="{{ app()->getLocale() === 'sw' ? $featured->title_sw : $featured->title_en }}" class="w-full h-72 lg:h-full object-cover">
                @else
                <div class="w-full h-72 lg:h-full bg-gradient-to-br from-gold/30 to-primary-dark flex items-center justify-center">
                    <svg class="w-24 h-24 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                @endif
                <div class="p-10 lg:p-14 text-white flex flex-col justify-center">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 bg-gold text-white text-xs font-bold rounded-full uppercase">{{ app()->getLocale() === 'sw' ? 'Inakuja' : 'Upcoming' }}</span>
                        @php
                            $daysLeft = now()->diffInDays($featured->starts_at, false);
                        @endphp
                        @if($daysLeft > 0)
                        <span class="px-3 py-1 bg-white/20 text-white text-xs font-bold rounded-full">
                            {{ $daysLeft }} {{ $daysLeft === 1 ? (app()->getLocale() === 'sw' ? 'siku imebaki' : 'day left') : (app()->getLocale() === 'sw' ? 'siku zimebaki' : 'days left') }}
                        </span>
                        @endif
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold mb-4">{{ app()->getLocale() === 'sw' ? $featured->title_sw : $featured->title_en }}</h3>
                    <p class="text-white/70 mb-6 line-clamp-3">{{ app()->getLocale() === 'sw' ? $featured->description_sw : $featured->description_en }}</p>
                    <div class="flex flex-wrap items-center gap-4 text-sm text-white/80 mb-6">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $featured->starts_at->format('M d, Y') }}
                        </span>
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $featured->starts_at->format('H:i') }}
                        </span>
                        @if($featured->location)
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $featured->location }}
                        </span>
                        @endif
                    </div>
                    @if($featured->button_url)
                    <a href="{{ $featured->button_url }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 px-8 py-3 bg-gold text-white font-bold rounded-xl hover:bg-gold-light transition shadow-lg w-fit">
                        {{ $featured->button_text ?? (app()->getLocale() === 'sw' ? 'Jiunge Nasi' : 'Join Us') }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Other Upcoming Events --}}
        @if($upcoming->count() > 1)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($upcoming->skip(1) as $event)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                @if($event->featured_image)
                <img src="{{ asset('storage/' . $event->featured_image) }}" alt="{{ app()->getLocale() === 'sw' ? $event->title_sw : $event->title_en }}" class="w-full h-48 object-cover">
                @else
                <div class="bg-gradient-to-br from-primary to-primary-dark p-8 text-white text-center">
                    <div class="text-4xl font-bold">{{ $event->starts_at->format('d') }}</div>
                    <div class="text-lg uppercase">{{ $event->starts_at->format('M Y') }}</div>
                </div>
                @endif
                <div class="p-6">
                    @php $days = now()->diffInDays($event->starts_at, false); @endphp
                    @if($days > 0)
                    <span class="inline-block px-3 py-1 bg-gold/10 text-gold text-xs font-bold rounded-full mb-3">
                        {{ $days }} {{ app()->getLocale() === 'sw' ? 'siku zimebaki' : 'days to go' }}
                    </span>
                    @endif
                    <h3 class="font-bold text-xl text-gray-900 mb-2">{{ app()->getLocale() === 'sw' ? $event->title_sw : $event->title_en }}</h3>
                    <div class="flex items-center gap-3 text-sm text-gray-500 mb-3">
                        <span>{{ $event->starts_at->format('M d, Y — H:i') }}</span>
                    </div>
                    @if($event->location)
                    <p class="text-sm text-gray-500 mb-4 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $event->location }}
                    </p>
                    @endif
                    @if($event->button_url)
                    <a href="{{ $event->button_url }}" target="_blank" rel="noopener"
                       class="inline-flex items-center px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-dark transition w-full justify-center">
                        {{ $event->button_text ?? (app()->getLocale() === 'sw' ? 'Jiunge' : 'Join') }}
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif

{{-- Service Times --}}
<section class="py-20 bg-gray-soft">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Kila Wiki' : 'Every Week' }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">{{ app()->getLocale() === 'sw' ? 'Ratiba ya Ibada' : 'Weekly Services' }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 text-center shadow-sm border border-gray-100 hover:-translate-y-1 transition-transform" data-aos="fade-up">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-5">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ app()->getLocale() === 'sw' ? 'Ibada ya Jumapili' : 'Sunday Service' }}</h3>
                <p class="text-gold font-semibold text-lg">9:00 AM & 11:00 AM</p>
                <p class="text-gray-500 mt-2 text-sm">{{ app()->getLocale() === 'sw' ? 'Ibada, Neno, na Ushirika' : 'Worship, Word & Fellowship' }}</p>
            </div>
            <div class="bg-white rounded-2xl p-8 text-center shadow-sm border border-gray-100 hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-gold/10 rounded-full flex items-center justify-center mx-auto mb-5">
                    <svg class="w-8 h-8 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ app()->getLocale() === 'sw' ? 'Sala ya Jumatano' : 'Wednesday Prayer' }}</h3>
                <p class="text-gold font-semibold text-lg">6:00 PM</p>
                <p class="text-gray-500 mt-2 text-sm">{{ app()->getLocale() === 'sw' ? 'Maombi na Kuombea' : 'Prayer & Intercession' }}</p>
            </div>
            <div class="bg-white rounded-2xl p-8 text-center shadow-sm border border-gray-100 hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-5">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ app()->getLocale() === 'sw' ? 'Darasa la Ijumaa' : 'Friday Bible Study' }}</h3>
                <p class="text-gold font-semibold text-lg">5:30 PM</p>
                <p class="text-gray-500 mt-2 text-sm">{{ app()->getLocale() === 'sw' ? 'Masomo ya Neno la Mungu' : 'Deep dive into God\'s Word' }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Past Events --}}
@if($past->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Yaliyopita' : 'Past Events' }}</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-3">{{ app()->getLocale() === 'sw' ? 'Matukio Yaliyopita' : 'Previous Events' }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($past->take(6) as $event)
            <div class="bg-gray-soft rounded-xl p-6 border border-gray-100 opacity-80" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center text-center shrink-0">
                        <div>
                            <span class="block text-xs font-bold text-gray-600">{{ $event->starts_at->format('M') }}</span>
                            <span class="block text-lg font-bold text-gray-900 leading-none">{{ $event->starts_at->format('d') }}</span>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">{{ app()->getLocale() === 'sw' ? $event->title_sw : $event->title_en }}</h3>
                        @if($event->location)
                        <p class="text-xs text-gray-500">{{ $event->location }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@elseif(!$upcoming->count())
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ __('site.events.no_events') }}</h2>
        <p class="text-gray-500">{{ app()->getLocale() === 'sw' ? 'Fuatilia mitandao yetu kwa matukio yanayokuja.' : 'Follow our social media for upcoming events.' }}</p>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-16 bg-gradient-to-r from-primary-dark to-primary text-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-2xl md:text-3xl font-bold mb-4">{{ app()->getLocale() === 'sw' ? 'Usiache Tukio Lolote' : 'Never Miss an Event' }}</h2>
        <p class="text-white/70 mb-8">{{ app()->getLocale() === 'sw' ? 'Fuatilia channel yetu ya YouTube kwa matukio ya moja kwa moja.' : 'Follow our YouTube channel for live events.' }}</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="https://www.youtube.com/@ApostleMathayonnko" target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 px-8 py-4 bg-gold text-white font-bold rounded-xl hover:bg-gold-light transition shadow-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                YouTube
            </a>
            <a href="{{ route('contact', request()->route('locale') ?? 'en') }}"
               class="inline-flex items-center gap-2 px-8 py-4 border-2 border-white text-white font-bold rounded-xl hover:bg-white hover:text-primary transition">
                {{ app()->getLocale() === 'sw' ? 'Wasiliana Nasi' : 'Contact Us' }}
            </a>
        </div>
    </div>
</section>
@endsection
