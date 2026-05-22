@extends('layouts.app')
@section('title', __('site.about.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-40 bg-dark overflow-hidden">
    @php $aboutImage = \App\Models\SiteSetting::get('about_image'); @endphp
    @if($aboutImage)
    <img src="{{ asset('storage/' . $aboutImage) }}" alt="About NDPCC" class="absolute inset-0 w-full h-full object-cover">
    @endif
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/90 via-dark/80 to-dark"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-2 bg-gold/20 text-gold text-sm font-semibold rounded-full mb-6" data-aos="fade-up">{{ app()->getLocale() === 'sw' ? 'Kuhusu Sisi' : 'About Us' }}</span>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6" data-aos="fade-up" data-aos-delay="100">{{ __('site.about.subtitle') }}</h1>
        <p class="text-xl text-white/70 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            {{ app()->getLocale() === 'sw' ? 'Kanisa lililojengwa juu ya msingi wa Neno la Mungu, likitumikia Arusha na mataifa.' : 'A church built on the foundation of God\'s Word, serving Arusha and the nations.' }}
        </p>
    </div>
</section>

{{-- Who We Are --}}
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div data-aos="fade-right">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Sisi Ni Nani' : 'Who We Are' }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3 mb-6">Nayoth Divine Power Christian Centre</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                {{ app()->getLocale() === 'sw' ? 'NDPCC ni kanisa lililoko Arusha, Tanzania, lililoanzishwa mwaka 2007 chini ya uongozi wa Mtume Mathayo Nnko. Jina "Nayoth" linatoka katika Biblia (1 Samweli 19:18-24) — mahali pa usalama na nguvu ya Mungu.' : 'NDPCC is a church located in Arusha, Tanzania, founded in 2007 under the leadership of Apostle Mathayo Nnko. The name "Nayoth" comes from the Bible (1 Samuel 19:18-24) — a place of safety and God\'s power.' }}
            </p>
            <p class="text-gray-600 leading-relaxed mb-6">
                {{ app()->getLocale() === 'sw' ? 'Tunaamini katika nguvu ya Injili kubadilisha maisha, kujenga familia, na kufikia mataifa kwa upendo wa Kristo.' : 'We believe in the power of the Gospel to transform lives, build families, and reach nations with the love of Christ.' }}
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('sermons', request()->route('locale') ?? 'en') }}" class="px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition">
                    {{ app()->getLocale() === 'sw' ? 'Tazama Mahubiri' : 'Watch Sermons' }}
                </a>
                <a href="{{ route('contact', request()->route('locale') ?? 'en') }}" class="px-6 py-3 border-2 border-primary text-primary font-semibold rounded-lg hover:bg-primary hover:text-white transition">
                    {{ app()->getLocale() === 'sw' ? 'Wasiliana Nasi' : 'Contact Us' }}
                </a>
            </div>
        </div>
        <div class="relative" data-aos="fade-left">
            <div class="bg-gradient-to-br from-primary/20 to-gold/20 rounded-2xl p-8">
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">{{ app()->getLocale() === 'sw' ? 'Makao Makuu' : 'Headquarters' }}</h3>
                        <p class="text-gray-500 mt-1">Arusha, Tanzania</p>
                        <div class="mt-4 pt-4 border-t border-gray-100 grid grid-cols-2 gap-4 text-center">
                            <div>
                                <p class="text-2xl font-bold text-primary">5+</p>
                                <p class="text-xs text-gray-500">{{ app()->getLocale() === 'sw' ? 'Matawi' : 'Branches' }}</p>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gold">30+</p>
                                <p class="text-xs text-gray-500">{{ app()->getLocale() === 'sw' ? 'Miaka' : 'Years' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Timeline --}}
<section class="py-20 bg-gray-soft">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Safari Yetu' : 'Our Journey' }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">{{ __('site.about.history_title') }}</h2>
        </div>
        <div class="relative border-l-2 border-primary/30 ml-4 md:ml-0 md:mx-auto md:max-w-2xl">
            @foreach(__('site.about.timeline') as $year => $text)
            <div class="mb-10 ml-8" data-aos="fade-left" data-aos-delay="{{ $loop->index * 150 }}">
                <div class="absolute -left-3 w-6 h-6 bg-primary rounded-full border-4 border-white shadow"></div>
                <span class="inline-block px-4 py-1.5 bg-gold/20 text-gold text-sm font-bold rounded-full mb-2">{{ ucfirst($year) }}</span>
                <p class="text-gray-700 text-lg">{{ $text }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Vision & Mission --}}
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-10">
        <div class="bg-gradient-to-br from-primary to-primary-dark rounded-2xl p-10 text-white" data-aos="fade-up">
            <div class="w-14 h-14 bg-white/10 rounded-xl flex items-center justify-center mb-6">
                <svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </div>
            <h3 class="text-2xl font-bold mb-4">{{ __('site.about.vision_title') }}</h3>
            <p class="text-white/80 leading-relaxed text-lg">{{ __('site.about.vision_text') }}</p>
        </div>
        <div class="bg-gradient-to-br from-gold to-amber-600 rounded-2xl p-10 text-white" data-aos="fade-up" data-aos-delay="100">
            <div class="w-14 h-14 bg-white/10 rounded-xl flex items-center justify-center mb-6">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h3 class="text-2xl font-bold mb-4">{{ __('site.about.mission_title') }}</h3>
            <p class="text-white/80 leading-relaxed text-lg">{{ __('site.about.mission_text') }}</p>
        </div>
    </div>
</section>

{{-- Leadership --}}
<section class="py-20 bg-gray-soft">
    <div class="max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
        <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Uongozi' : 'Leadership' }}</span>
        <h2 class="text-3xl font-bold text-gray-900 mt-3 mb-8">Apostle Mathayo Nnko</h2>
        <p class="text-gray-600 leading-relaxed text-lg max-w-2xl mx-auto mb-8">
            {{ app()->getLocale() === 'sw' ? 'Mtume Mathayo Nnko ni mwanzilishi na kiongozi wa NDPCC. Mungu alianza kufanya kazi kupitia mtumishi wake tangu mwaka 1992 nchini Tanzania, na kanisa lilianzishwa rasmi mwaka 2007.' : 'Apostle Mathayo Nnko is the founder and leader of NDPCC. God began working through His servant since 1992 in Tanzania, and the church was officially established in 2007.' }}
        </p>
        <a href="https://www.youtube.com/@ApostleMathayonnko" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            {{ app()->getLocale() === 'sw' ? 'Tazama YouTube' : 'Watch on YouTube' }}
        </a>
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

{{-- CTA --}}
<section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">{{ app()->getLocale() === 'sw' ? 'Jiunge Na Familia Yetu' : 'Join Our Family' }}</h2>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('events', request()->route('locale') ?? 'en') }}" class="px-8 py-4 bg-gold text-white font-bold rounded-lg hover:bg-gold-light transition shadow-lg">
                {{ app()->getLocale() === 'sw' ? 'Tazama Matukio' : 'View Events' }}
            </a>
            <a href="{{ route('give', request()->route('locale') ?? 'en') }}" class="px-8 py-4 border-2 border-gold text-gold font-bold rounded-lg hover:bg-gold hover:text-white transition">
                {{ app()->getLocale() === 'sw' ? 'Toa Sadaka' : 'Give an Offering' }}
            </a>
        </div>
    </div>
</section>
@endsection
