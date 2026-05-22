@extends('layouts.app')
@section('title', __('site.radio.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-32 bg-dark overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/90 to-dark"></div>
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-gold rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-48 h-48 bg-primary rounded-full blur-3xl"></div>
    </div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-gold/20 text-gold text-sm font-semibold rounded-full mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728M9.172 15.828a5 5 0 010-7.072m5.656 0a5 5 0 010 7.072M12 12h.01"/></svg>
            NDPCC Radio
        </div>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6" data-aos="fade-up">
            {{ app()->getLocale() === 'sw' ? 'Neno la Mungu Linaendelea' : 'The Word of God Continues' }}
        </h1>
        <p class="text-xl text-white/70 max-w-2xl mx-auto mb-10" data-aos="fade-up" data-aos-delay="100">
            {{ app()->getLocale() === 'sw' ? 'Kusambaza Injili kupitia mafundisho, ibada, na nguvu ya Neno. Kufikia mataifa kwa sauti ya tumaini.' : 'Spreading the Gospel through teaching, worship, and the power of the Word. Reaching nations with a voice of hope.' }}
        </p>
    </div>
</section>

{{-- Live Player Section --}}
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4">
        <div class="bg-gradient-to-r from-primary-dark to-primary rounded-2xl p-8 md:p-12 text-white shadow-xl" data-aos="fade-up">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-4">
                        @php $radioLive = \App\Models\SiteSetting::get('radio_is_live', 'false') === 'true'; @endphp
                        @if($radioLive)
                        <span class="flex items-center gap-2 px-3 py-1 bg-red-500 text-white text-xs font-bold rounded-full">
                            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                            {{ __('site.radio.live_badge') }}
                        </span>
                        @else
                        <span class="flex items-center gap-2 px-3 py-1 bg-white/20 text-white/80 text-xs font-bold rounded-full">
                            {{ __('site.radio.off_air') }}
                        </span>
                        @endif
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold mb-3">{{ __('site.radio.title') }}</h2>
                    <p class="text-white/70 mb-6">
                        {{ app()->getLocale() === 'sw' ? 'Sikiliza mafundisho, mahubiri, na muziki wa ibada moja kwa moja.' : 'Listen to teachings, sermons, and worship music live.' }}
                    </p>
                    @php $streamUrl = \App\Models\SiteSetting::get('radio_stream_url'); @endphp
                    @if($streamUrl)
                    <audio id="radio-player" controls class="w-full rounded-lg">
                        <source src="{{ $streamUrl }}" type="audio/mpeg">
                        {{ app()->getLocale() === 'sw' ? 'Kivinjari chako hakitumii audio.' : 'Your browser does not support audio.' }}
                    </audio>
                    @else
                    <p class="text-white/60 italic">{{ app()->getLocale() === 'sw' ? 'Kituo cha redio kitaanza hivi karibuni.' : 'Radio station coming soon.' }}</p>
                    @endif
                </div>
                <div class="shrink-0">
                    <div class="w-32 h-32 bg-white/10 rounded-full flex items-center justify-center backdrop-blur">
                        <svg class="w-16 h-16 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728M9.172 15.828a5 5 0 010-7.072m5.656 0a5 5 0 010 7.072M12 12h.01"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Programs Schedule --}}
<section class="py-20 bg-gray-soft">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Ratiba Yetu' : 'Our Programs' }}</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-3">{{ __('site.radio.schedule_title') }}</h2>
            <p class="text-gray-500 mt-2 max-w-lg mx-auto">{{ app()->getLocale() === 'sw' ? 'Maudhui yaliyoandaliwa kukuhamasisha na kukuimarisha. Muda wote ni EAT (UTC+3).' : 'Content crafted to inspire and strengthen you. All times in EAT (UTC+3).' }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $programs = [
                    ['name_en' => 'Sunday Live Service', 'name_sw' => 'Ibada ya Moja kwa Moja', 'time' => 'Sun, 9:00 AM - 12:00 PM', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'primary'],
                    ['name_en' => 'Morning Prayer', 'name_sw' => 'Sala ya Asubuhi', 'time' => 'Mon - Fri, 6:00 - 7:00 AM', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'color' => 'gold'],
                    ['name_en' => 'Bible Teachings', 'name_sw' => 'Masomo ya Biblia', 'time' => 'Mon - Fri, 7:00 - 8:00 PM', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'color' => 'primary'],
                    ['name_en' => 'Evening Prayer', 'name_sw' => 'Sala ya Jioni', 'time' => 'Wed, 6:00 - 7:30 PM', 'icon' => 'M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z', 'color' => 'gold'],
                    ['name_en' => 'Sermon Replay', 'name_sw' => 'Mahubiri Yaliyopita', 'time' => 'Thu, 7:00 - 8:00 PM', 'icon' => 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z', 'color' => 'primary'],
                    ['name_en' => 'Praise & Worship', 'name_sw' => 'Muziki wa Ibada', 'time' => 'Sat, 8:00 - 10:00 PM', 'icon' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z', 'color' => 'gold'],
                ];
            @endphp

            @foreach($programs as $program)
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-{{ $program['color'] }}/10 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-{{ $program['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $program['icon'] }}"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">{{ app()->getLocale() === 'sw' ? $program['name_sw'] : $program['name_en'] }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $program['time'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">{{ app()->getLocale() === 'sw' ? 'Sikiliza Popote Ulipo' : 'Listen Wherever You Are' }}</h2>
        <p class="text-gray-500 mb-8 max-w-lg mx-auto">{{ app()->getLocale() === 'sw' ? 'Fuatilia mafundisho na ibada kupitia YouTube channel yetu.' : 'Follow our teachings and worship through our YouTube channel.' }}</p>
        <a href="https://www.youtube.com/@ApostleMathayonnko" target="_blank" rel="noopener"
           class="inline-flex items-center gap-3 px-8 py-4 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition shadow-lg">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            {{ app()->getLocale() === 'sw' ? 'Tazama YouTube' : 'Watch on YouTube' }}
        </a>
    </div>
</section>
@endsection
