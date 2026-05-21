@extends('layouts.app')
@section('title', __('site.ministries.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-32 bg-dark">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/80 to-dark"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">{{ __('site.ministries.title') }}</h1>
        <p class="text-lg text-white/70" data-aos="fade-up" data-aos-delay="100">{{ __('site.ministries.subtitle') }}</p>
    </div>
</section>

{{-- Ministries Grid --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($ministries as $ministry)
            <div class="bg-white rounded-xl shadow-md p-8 border-l-4 border-primary hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <h3 class="text-xl font-bold text-primary mb-3">
                    {{ app()->getLocale() === 'sw' ? $ministry->name_sw : $ministry->name_en }}
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ app()->getLocale() === 'sw' ? $ministry->description_sw : $ministry->description_en }}
                </p>
                @if($ministry->leader)
                <p class="mt-4 text-sm text-gold font-medium">👤 {{ $ministry->leader }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
