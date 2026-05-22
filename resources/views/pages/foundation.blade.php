@extends('layouts.app')
@section('title', __('site.foundation.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-32 bg-dark">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/80 to-dark"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">{{ __('site.foundation.title') }}</h1>
        <p class="text-lg text-white/70" data-aos="fade-up" data-aos-delay="100">{{ __('site.foundation.subtitle') }}</p>
    </div>
</section>

{{-- Mission --}}
<section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <p class="text-xl text-gray-700 leading-relaxed">{{ __('site.foundation.mission') }}</p>
    </div>
</section>

{{-- Impact Stats --}}
<section class="py-16 bg-gray-soft" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div>
            <div class="text-4xl font-bold text-primary" data-counter="500">0+</div>
            <p class="text-gray-600 mt-2 text-sm">{{ __('site.foundation.stats_families') }}</p>
        </div>
        <div>
            <div class="text-4xl font-bold text-primary" data-counter="200">0+</div>
            <p class="text-gray-600 mt-2 text-sm">{{ __('site.foundation.stats_children') }}</p>
        </div>
        <div>
            <div class="text-4xl font-bold text-primary" data-counter="80">0+</div>
            <p class="text-gray-600 mt-2 text-sm">{{ __('site.foundation.stats_widows') }}</p>
        </div>
        <div>
            <div class="text-4xl font-bold text-primary" data-counter="17">0+</div>
            <p class="text-gray-600 mt-2 text-sm">{{ __('site.foundation.stats_years') }}</p>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-gradient-to-r from-primary-dark to-primary text-white text-center" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">{{ __('site.foundation.cta') }}</h2>
        <a href="{{ route('give', request()->route('locale') ?? 'en') }}" class="inline-block px-8 py-4 bg-gold text-white font-semibold rounded-lg hover:bg-gold-light transition shadow-lg text-lg">
            {{ __('site.nav.give') }}
        </a>
    </div>
</section>
@endsection
