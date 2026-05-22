@extends('layouts.app')
@section('title', app()->getLocale() === 'sw' ? 'Toa Sadaka' : 'Give an Offering')

@section('content')
{{-- Hero --}}
<section class="relative py-40 bg-dark overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/90 via-dark/80 to-dark"></div>
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 left-1/4 w-80 h-80 bg-gold rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-1/3 w-64 h-64 bg-primary rounded-full blur-3xl"></div>
    </div>
    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-2 bg-gold/20 text-gold text-sm font-semibold rounded-full mb-6" data-aos="fade-up">
            {{ app()->getLocale() === 'sw' ? 'Sadaka & Zaka' : 'Offerings & Tithes' }}
        </span>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6" data-aos="fade-up" data-aos-delay="100">
            {{ app()->getLocale() === 'sw' ? 'Toa Sadaka Yako' : 'Give an Offering' }}
        </h1>
        <p class="text-xl text-white/70 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            {{ app()->getLocale() === 'sw' ? 'Kila sadaka yako inasaidia kueneza Injili na kubadilisha maisha.' : 'Every offering you give helps spread the Gospel and transform lives.' }}
        </p>
    </div>
</section>

{{-- Scripture --}}
<section class="py-12 bg-gold/10" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <blockquote class="text-xl md:text-2xl font-serif italic text-gray-700 leading-relaxed">
            {{ app()->getLocale() === 'sw' ? '"Umeuvika mwaka taji ya wema wako; Mapito yako yadondoza unono."' : '"You crown the year with Your goodness, and Your paths drip with abundance."' }}
        </blockquote>
        <p class="text-gold font-semibold mt-4">— {{ app()->getLocale() === 'sw' ? 'Zaburi 65:11' : 'Psalm 65:11' }}</p>
    </div>
</section>

{{-- Second Scripture --}}
<section class="py-6 bg-white" data-aos="fade-up">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <p class="text-gray-600 italic">
            {{ app()->getLocale() === 'sw' ? '"Mwenyezi Mungu akamuambia Musa; Sasa ninafanya agano na watu wako, Nitatenda maajabu mbele yao ambayo hayajapata kutendwa duniani kote."' : '"The Lord said to Moses: I am making a covenant with your people. I will perform wonders before them that have never been done in all the earth."' }}
        </p>
        <p class="text-gold font-semibold mt-2 text-sm">— {{ app()->getLocale() === 'sw' ? 'Kutoka 34:10' : 'Exodus 34:10' }}</p>
    </div>
</section>

{{-- Giving Options --}}
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Njia za Kutoa' : 'Ways to Give' }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">{{ app()->getLocale() === 'sw' ? 'Chagua Njia Yako' : 'Choose Your Method' }}</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            {{-- Airtel Money --}}
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 text-center hover:-translate-y-2 transition-all duration-300 group" data-aos="fade-up">
                <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform" style="background-color: #ED1C24; opacity: 0.1;">
                </div>
                <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 -mt-20 relative" style="background-color: rgba(237, 28, 36, 0.1);">
                    <svg class="w-9 h-9" style="color: #ED1C24;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Airtel Money</h3>
                <p class="text-gray-500 mb-6">{{ app()->getLocale() === 'sw' ? 'Tuma sadaka yako kupitia Airtel Money' : 'Send your offering via Airtel Money' }}</p>
                <div class="rounded-2xl py-5 px-6" style="background-color: rgba(237, 28, 36, 0.05);">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">{{ app()->getLocale() === 'sw' ? 'Namba' : 'Number' }}</p>
                    <p class="text-3xl font-bold" style="color: #ED1C24;">+255 784 363 502</p>
                </div>
            </div>

            {{-- Lipa Namba (Vodacom) --}}
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 text-center hover:-translate-y-2 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-9 h-9 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Lipa Namba</h3>
                <p class="text-gray-500 mb-6">Vodacom M-Pesa</p>
                <div class="bg-blue-50 rounded-2xl py-5 px-6">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">{{ app()->getLocale() === 'sw' ? 'Namba' : 'Number' }}</p>
                    <p class="text-3xl font-bold text-blue-600">58268290</p>
                </div>
            </div>

            {{-- NMB Bank --}}
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 text-center hover:-translate-y-2 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-9 h-9 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">NMB Bank</h3>
                <p class="text-gray-500 mb-6">{{ app()->getLocale() === 'sw' ? 'Tuma kupitia akaunti ya benki' : 'Send via bank account' }}</p>
                <div class="bg-amber-50 rounded-2xl py-5 px-6">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Account Number</p>
                    <p class="text-3xl font-bold text-primary">40810146696</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Categories --}}
<section class="py-16 bg-gray-soft" data-aos="fade-up">
    <div class="max-w-5xl mx-auto px-4 text-center">
        <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ app()->getLocale() === 'sw' ? 'Aina za Sadaka' : 'Giving Categories' }}</h3>
        <p class="text-gray-500 mb-8 max-w-lg mx-auto">{{ app()->getLocale() === 'sw' ? 'Tumia moja ya hizi kama rejeleo wakati wa kutoa sadaka yako.' : 'Use one of these as a reference when making your offering.' }}</p>
        <div class="flex flex-wrap justify-center gap-4">
            @foreach(__('site.give.categories') as $key => $label)
            <span class="px-6 py-3 bg-white text-gray-800 font-semibold rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">{{ $label }}</span>
            @endforeach
        </div>
    </div>
</section>

{{-- Why Give --}}
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Kwa Nini Kutoa' : 'Why Give' }}</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-3">{{ app()->getLocale() === 'sw' ? 'Sadaka Yako Inafanya Nini' : 'What Your Offering Does' }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center" data-aos="fade-up">
                <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ app()->getLocale() === 'sw' ? 'Kueneza Injili' : 'Spreading the Gospel' }}</h3>
                <p class="text-gray-600 text-sm">{{ app()->getLocale() === 'sw' ? 'Sadaka yako inasaidia kufikia mataifa kwa Neno la Mungu kupitia YouTube, redio, na mikutano.' : 'Your offering helps reach nations with God\'s Word through YouTube, radio, and conferences.' }}</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-gold/10 rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <svg class="w-8 h-8 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ app()->getLocale() === 'sw' ? 'Kusaidia Wahitaji' : 'Helping the Needy' }}</h3>
                <p class="text-gray-600 text-sm">{{ app()->getLocale() === 'sw' ? 'Tunasaidia wajane, yatima, na familia zenye uhitaji kupitia Foundation yetu.' : 'We support widows, orphans, and families in need through our Foundation.' }}</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ app()->getLocale() === 'sw' ? 'Kujenga Kanisa' : 'Building the Church' }}</h3>
                <p class="text-gray-600 text-sm">{{ app()->getLocale() === 'sw' ? 'Sadaka yako inasaidia kuendeleza huduma za kanisa na kujenga miundombinu.' : 'Your offering helps sustain church operations and build infrastructure.' }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Contact CTA --}}
<section class="py-20 bg-gradient-to-r from-primary-dark to-primary text-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ app()->getLocale() === 'sw' ? 'Kwa Maombi na Ushauri' : 'For Prayers and Counsel' }}</h2>
        <p class="text-white/70 text-lg mb-8">{{ app()->getLocale() === 'sw' ? 'Wasiliana nasi kwa maombi, ushauri, au maswali yoyote kuhusu sadaka.' : 'Contact us for prayers, counsel, or any questions about giving.' }}</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="tel:+255784363502" class="inline-flex items-center gap-3 px-8 py-4 bg-gold text-white font-bold rounded-xl hover:bg-gold-light transition shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                +255 784 363 502
            </a>
            <a href="{{ route('foundation', request()->route('locale') ?? 'en') }}" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-white text-white font-bold rounded-xl hover:bg-white hover:text-primary transition">
                {{ app()->getLocale() === 'sw' ? 'Foundation' : 'Support Foundation' }}
            </a>
            <a href="{{ route('prayer', request()->route('locale') ?? 'en') }}" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-white/50 text-white/90 font-bold rounded-xl hover:bg-white hover:text-primary transition">
                {{ app()->getLocale() === 'sw' ? 'Omba Maombi' : 'Prayer Request' }}
            </a>
        </div>
    </div>
</section>
@endsection
