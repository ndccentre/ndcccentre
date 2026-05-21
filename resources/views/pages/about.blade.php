@extends('layouts.app')
@section('title', __('site.about.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-32 bg-dark overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/80 to-dark"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">{{ __('site.about.title') }}</h1>
        <p class="text-lg text-white/70" data-aos="fade-up" data-aos-delay="100">{{ __('site.about.subtitle') }}</p>
    </div>
</section>

{{-- Timeline --}}
<section class="py-20 bg-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-primary text-center mb-12">{{ __('site.about.history_title') }}</h2>
        <div class="relative border-l-2 border-primary/30 ml-4 md:ml-0 md:mx-auto md:max-w-2xl">
            @foreach(__('site.about.timeline') as $year => $text)
            <div class="mb-10 ml-6" data-aos="fade-left" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="absolute -left-3 w-6 h-6 bg-primary rounded-full border-4 border-white"></div>
                <span class="inline-block px-3 py-1 bg-gold/20 text-gold text-sm font-bold rounded mb-2">{{ ucfirst($year) }}</span>
                <p class="text-gray-700">{{ $text }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Vision & Mission --}}
<section class="py-20 bg-gray-soft" data-aos="fade-up">
    <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-12">
        <div class="bg-white p-8 rounded-xl shadow-md border-t-4 border-primary">
            <h3 class="text-2xl font-bold text-primary mb-4">{{ __('site.about.vision_title') }}</h3>
            <p class="text-gray-700 leading-relaxed">{{ __('site.about.vision_text') }}</p>
        </div>
        <div class="bg-white p-8 rounded-xl shadow-md border-t-4 border-gold">
            <h3 class="text-2xl font-bold text-gold mb-4">{{ __('site.about.mission_title') }}</h3>
            <p class="text-gray-700 leading-relaxed">{{ __('site.about.mission_text') }}</p>
        </div>
    </div>
</section>

{{-- Scripture --}}
<section class="py-20 bg-gradient-to-r from-primary-dark to-primary text-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <blockquote class="text-2xl md:text-3xl font-serif italic leading-relaxed">
            {{ __('site.about.verse') }}
        </blockquote>
        <p class="mt-6 text-gold font-semibold text-lg">— {{ __('site.about.verse_ref') }}</p>
    </div>
</section>
@endsection
