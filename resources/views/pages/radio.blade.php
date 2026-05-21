@extends('layouts.app')
@section('title', __('site.radio.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-32 bg-dark">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/80 to-dark"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">{{ __('site.radio.title') }}</h1>
        <p class="text-lg text-white/70" data-aos="fade-up" data-aos-delay="100">{{ __('site.radio.subtitle') }}</p>
    </div>
</section>

{{-- Live Player --}}
<section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-gradient-to-r from-primary-dark to-primary rounded-2xl p-8 text-white text-center">
            {{-- Live Badge --}}
            <div class="flex items-center justify-center gap-2 mb-6">
                @if($isLive)
                <span class="w-3 h-3 bg-red-500 rounded-full animate-live-dot"></span>
                <span class="text-sm font-bold uppercase tracking-wider">{{ __('site.radio.live_badge') }}</span>
                @else
                <span class="w-3 h-3 bg-gray-400 rounded-full"></span>
                <span class="text-sm font-bold uppercase tracking-wider text-white/60">{{ __('site.radio.off_air') }}</span>
                @endif
            </div>

            @if($currentProgram)
            <p class="text-white/70 text-sm mb-2">{{ __('site.radio.now_playing') }}</p>
            <p class="text-xl font-bold text-gold mb-6">{{ $currentProgram }}</p>
            @endif

            @if($isLive && $streamUrl)
            <audio controls class="w-full max-w-md mx-auto">
                <source src="{{ $streamUrl }}" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            @endif
        </div>
    </div>
</section>

{{-- Schedule --}}
<section class="py-16 bg-gray-soft" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-primary text-center mb-10">{{ __('site.radio.schedule_title') }}</h2>
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">{{ app()->getLocale() === 'sw' ? 'Siku' : 'Day' }}</th>
                        <th class="px-6 py-4 text-left font-semibold">{{ app()->getLocale() === 'sw' ? 'Mpango' : 'Program' }}</th>
                        <th class="px-6 py-4 text-left font-semibold">{{ app()->getLocale() === 'sw' ? 'Wakati' : 'Time' }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach(__('site.radio.days') as $i => $day)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $day }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ __('site.radio.programs')[$i] }}</td>
                        <td class="px-6 py-4 text-gold font-medium">{{ __('site.radio.times')[$i] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
