@extends('layouts.app')
@section('title', __('site.foundation.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-40 bg-dark overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/90 via-dark/80 to-dark"></div>
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 left-10 w-72 h-72 bg-gold rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-20 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
    </div>
    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-2 bg-gold/20 text-gold text-sm font-semibold rounded-full mb-6" data-aos="fade-up">
            {{ app()->getLocale() === 'sw' ? 'Gibea ya Mungu Nayoth' : 'Gibea of God Nayoth' }}
        </span>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight" data-aos="fade-up" data-aos-delay="100">
            {{ __('site.foundation.title') }}
        </h1>
        <p class="text-xl text-white/70 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            {{ __('site.foundation.subtitle') }}
        </p>
    </div>
</section>

{{-- Mission Statement --}}
<section class="py-20 bg-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <div class="w-16 h-16 bg-gold/10 rounded-full flex items-center justify-center mx-auto mb-8">
            <svg class="w-8 h-8 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        </div>
        <p class="text-2xl text-gray-700 leading-relaxed font-serif italic">
            "{{ __('site.foundation.mission') }}"
        </p>
    </div>
</section>

{{-- What We Do --}}
<section class="py-20 bg-gray-soft">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Tunachofanya' : 'What We Do' }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">{{ app()->getLocale() === 'sw' ? 'Kujenga Jamii, Kubadilisha Maisha' : 'Building Communities, Transforming Lives' }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:-translate-y-1 transition-transform" data-aos="fade-up">
                <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ app()->getLocale() === 'sw' ? 'Elimu' : 'Education' }}</h3>
                <p class="text-gray-600">{{ app()->getLocale() === 'sw' ? 'Tunasaidia watoto kupata elimu bora kupitia ufadhili wa shule na vifaa.' : 'We help children access quality education through school sponsorship and supplies.' }}</p>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-gold/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ app()->getLocale() === 'sw' ? 'Familia' : 'Families' }}</h3>
                <p class="text-gray-600">{{ app()->getLocale() === 'sw' ? 'Tunasaidia familia zenye uhitaji kwa chakula, mavazi, na makazi.' : 'We support families in need with food, clothing, and shelter.' }}</p>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ app()->getLocale() === 'sw' ? 'Wajane & Yatima' : 'Widows & Orphans' }}</h3>
                <p class="text-gray-600">{{ app()->getLocale() === 'sw' ? 'Tunawasaidia wajane na yatima kupata tumaini na msaada wa kila siku.' : 'We provide hope and daily support to widows and orphans.' }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Impact Stats --}}
<section class="py-20 bg-gradient-to-r from-primary-dark to-primary text-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div>
            <div class="text-5xl font-bold text-gold" data-counter="500">0+</div>
            <p class="text-white/70 mt-3">{{ __('site.foundation.stats_families') }}</p>
        </div>
        <div>
            <div class="text-5xl font-bold text-gold" data-counter="200">0+</div>
            <p class="text-white/70 mt-3">{{ __('site.foundation.stats_children') }}</p>
        </div>
        <div>
            <div class="text-5xl font-bold text-gold" data-counter="80">0+</div>
            <p class="text-white/70 mt-3">{{ __('site.foundation.stats_widows') }}</p>
        </div>
        <div>
            <div class="text-5xl font-bold text-gold" data-counter="17">0+</div>
            <p class="text-white/70 mt-3">{{ __('site.foundation.stats_years') }}</p>
        </div>
    </div>
</section>

{{-- Gallery --}}
@php
    $galleryImages = \App\Models\GalleryItem::where('category', 'foundation')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();
@endphp
@if($galleryImages->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Picha Zetu' : 'Our Gallery' }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">{{ app()->getLocale() === 'sw' ? 'Tunaona Matunda' : 'See the Impact' }}</h2>
        </div>

        {{-- Masonry Grid --}}
        <div class="columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
            @foreach($galleryImages as $item)
            <div class="break-inside-avoid" data-aos="fade-up" data-aos-delay="{{ $loop->index % 4 * 50 }}">
                <a href="{{ asset('storage/' . $item->image_path) }}"
                   class="glightbox block rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow group"
                   data-gallery="foundation"
                   data-title="{{ $item->title }}">
                    <img src="{{ asset('storage/' . $item->image_path) }}"
                         alt="{{ $item->title }}"
                         class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500"
                         loading="lazy">
                </a>
                @if($item->title)
                <p class="text-sm text-gray-600 mt-2 px-1">{{ $item->title }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Donate CTA --}}
<section class="py-20 bg-gray-soft" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <div class="bg-white rounded-3xl p-10 md:p-16 shadow-xl border border-gray-100">
            <div class="w-20 h-20 bg-gold/10 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-10 h-10 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'sw' ? 'Toa Kuwezesha' : 'Donate to Empower' }}
            </h2>
            <p class="text-lg text-gray-600 mb-8 max-w-xl mx-auto">
                {{ app()->getLocale() === 'sw' ? 'Sadaka yako inasaidia familia, watoto wa shule, na wajane. Kila shilingi inaleta mabadiliko.' : 'Your donation supports families, school children, and widows. Every shilling makes a difference.' }}
            </p>
            <a href="{{ route('give', request()->route('locale') ?? 'en') }}"
               class="inline-flex items-center gap-3 px-10 py-5 bg-gold text-white font-bold rounded-xl hover:bg-gold-light transition shadow-lg text-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                {{ app()->getLocale() === 'sw' ? 'Toa Sadaka Sasa' : 'Give an Offering Now' }}
            </a>
        </div>
    </div>
</section>
@endsection
