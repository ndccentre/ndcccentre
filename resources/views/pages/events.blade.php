@extends('layouts.app')
@section('title', __('site.events.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-32 bg-dark">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/80 to-dark"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">{{ __('site.events.title') }}</h1>
        <p class="text-lg text-white/70" data-aos="fade-up" data-aos-delay="100">{{ __('site.events.subtitle') }}</p>
    </div>
</section>

{{-- Events Grid --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        @if($events->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($events as $event)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="bg-gradient-to-r from-primary to-primary-dark p-6 text-white">
                    <div class="text-3xl font-bold">{{ $event->starts_at->format('d') }}</div>
                    <div class="text-sm uppercase">{{ $event->starts_at->format('M Y') }}</div>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-gray-900 mb-2">
                        {{ app()->getLocale() === 'sw' ? $event->title_sw : $event->title_en }}
                    </h3>
                    <p class="text-sm text-gray-600 mb-3">
                        {{ app()->getLocale() === 'sw' ? $event->description_sw : $event->description_en }}
                    </p>
                    <div class="flex items-center gap-4 text-xs text-gray-500">
                        <span>🕐 {{ $event->starts_at->format('H:i') }}</span>
                        @if($event->location)
                        <span>📍 {{ $event->location }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-12">{{ $events->links() }}</div>
        @else
        <p class="text-center text-gray-500 text-lg py-12">{{ __('site.events.no_events') }}</p>
        @endif
    </div>
</section>
@endsection
