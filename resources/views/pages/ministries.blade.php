@extends('layouts.app')
@section('title', __('site.ministries.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-40 bg-dark overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/90 via-dark/80 to-dark"></div>
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 left-1/4 w-72 h-72 bg-gold rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-1/4 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
    </div>
    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-2 bg-gold/20 text-gold text-sm font-semibold rounded-full mb-6" data-aos="fade-up">
            {{ app()->getLocale() === 'sw' ? 'Huduma za Kanisa' : 'Church Ministries' }}
        </span>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6" data-aos="fade-up" data-aos-delay="100">{{ __('site.ministries.title') }}</h1>
        <p class="text-xl text-white/70 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">{{ __('site.ministries.subtitle') }}</p>
    </div>
</section>

{{-- Ministries Grid --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        @if($ministries->count())
        @php
            $icons = [
                'heroicon-youth' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                'heroicon-women' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                'heroicon-men' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                'heroicon-children' => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                'heroicon-worship' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z',
                'heroicon-evangelism' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            ];
            $colors = ['primary', 'gold', 'primary', 'gold', 'primary', 'gold'];
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($ministries as $index => $ministry)
            @php $color = $colors[$index % count($colors)]; @endphp
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ $index * 80 }}">
                <div class="w-16 h-16 bg-{{ $color }}/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-{{ $color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icons[array_keys($icons)[$index % count($icons)]] }}"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">
                    {{ app()->getLocale() === 'sw' ? $ministry->name_sw : $ministry->name_en }}
                </h3>
                <p class="text-gray-600 leading-relaxed mb-5">
                    {{ app()->getLocale() === 'sw' ? $ministry->description_sw : $ministry->description_en }}
                </p>
                <a href="#" class="inline-flex items-center text-{{ $color }} font-semibold text-sm hover:gap-3 transition-all gap-2"
                   x-data x-on:click.prevent="$dispatch('open-ministry-form', { name: '{{ app()->getLocale() === 'sw' ? addslashes($ministry->name_sw) : addslashes($ministry->name_en) }}' })">
                    {{ app()->getLocale() === 'sw' ? 'Jiunge Nasi' : 'Join This Ministry' }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-gray-500 text-lg py-12">{{ app()->getLocale() === 'sw' ? 'Hakuna huduma kwa sasa.' : 'No ministries available.' }}</p>
        @endif
    </div>
</section>

{{-- Get Involved --}}
<section class="py-20 bg-gray-soft">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Shiriki' : 'Get Involved' }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">{{ app()->getLocale() === 'sw' ? 'Jinsi ya Kushiriki' : 'How to Get Involved' }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center" data-aos="fade-up">
                <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold">1</div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ app()->getLocale() === 'sw' ? 'Omba' : 'Pray' }}</h3>
                <p class="text-gray-600">{{ app()->getLocale() === 'sw' ? 'Omba kuhusu huduma inayokugusa moyo wako na jinsi Mungu anavyokutaka utumike.' : 'Pray about which ministry touches your heart and how God wants you to serve.' }}</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="w-20 h-20 bg-gold rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold">2</div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ app()->getLocale() === 'sw' ? 'Wasiliana' : 'Connect' }}</h3>
                <p class="text-gray-600">{{ app()->getLocale() === 'sw' ? 'Wasiliana nasi kupitia simu au WhatsApp ili kujua zaidi kuhusu huduma.' : 'Reach out to us via phone or WhatsApp to learn more about a ministry.' }}</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold">3</div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ app()->getLocale() === 'sw' ? 'Tumika' : 'Serve' }}</h3>
                <p class="text-gray-600">{{ app()->getLocale() === 'sw' ? 'Jiunge na timu na anza kutumika kwa utukufu wa Mungu.' : 'Join the team and start serving for the glory of God.' }}</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-gradient-to-r from-primary-dark to-primary text-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ app()->getLocale() === 'sw' ? 'Uko Tayari Kutumika?' : 'Ready to Serve?' }}</h2>
        <p class="text-white/70 text-lg mb-8 max-w-xl mx-auto">{{ app()->getLocale() === 'sw' ? 'Mungu amekupa karama za pekee. Tumia karama zako kumtumikia na kuimarisha kanisa.' : 'God has given you unique gifts. Use your gifts to serve Him and strengthen the church.' }}</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('contact', request()->route('locale') ?? 'en') }}" class="px-8 py-4 bg-gold text-white font-bold rounded-xl hover:bg-gold-light transition shadow-lg">
                {{ app()->getLocale() === 'sw' ? 'Wasiliana Nasi' : 'Contact Us' }}
            </a>
            <a href="{{ route('prayer', request()->route('locale') ?? 'en') }}" class="px-8 py-4 border-2 border-white text-white font-bold rounded-xl hover:bg-white hover:text-primary transition">
                {{ app()->getLocale() === 'sw' ? 'Omba Maombi' : 'Prayer Request' }}
            </a>
        </div>
    </div>
</section>

{{-- Ministry Join Modal --}}
<div x-data="{ open: false, ministry: '' }"
     x-on:open-ministry-form.window="open = true; ministry = $event.detail.name"
     x-show="open"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     x-cloak
     class="fixed inset-0 z-[100] flex items-center justify-center p-4">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" x-on:click="open = false"></div>

    {{-- Modal Content --}}
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 max-h-[90vh] overflow-y-auto"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">

        {{-- Close button --}}
        <button x-on:click="open = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        {{-- Header --}}
        <div class="text-center mb-6">
            <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ app()->getLocale() === 'sw' ? 'Jiunge na Huduma' : 'Join Ministry' }}</h3>
            <p class="text-primary font-semibold mt-1" x-text="ministry"></p>
        </div>

        {{-- Form --}}
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ app()->getLocale() === 'sw' ? 'Jina Lako Kamili' : 'Full Name' }} *</label>
                <input type="text" x-ref="mName" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition"
                       placeholder="{{ app()->getLocale() === 'sw' ? 'Andika jina lako' : 'Enter your full name' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ app()->getLocale() === 'sw' ? 'Namba ya Simu' : 'Phone Number' }} *</label>
                <input type="tel" x-ref="mPhone" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition"
                       placeholder="+255 7XX XXX XXX">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ app()->getLocale() === 'sw' ? 'Barua Pepe' : 'Email' }} ({{ app()->getLocale() === 'sw' ? 'hiari' : 'optional' }})</label>
                <input type="email" x-ref="mEmail"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition"
                       placeholder="{{ app()->getLocale() === 'sw' ? 'Barua pepe yako' : 'Your email' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ app()->getLocale() === 'sw' ? 'Ujumbe' : 'Message' }} ({{ app()->getLocale() === 'sw' ? 'hiari' : 'optional' }})</label>
                <textarea x-ref="mMessage" rows="3"
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition resize-none"
                          placeholder="{{ app()->getLocale() === 'sw' ? 'Kitu chochote unachotaka kutuambia...' : 'Anything you want to tell us...' }}"></textarea>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <button type="button"
                        x-on:click="
                            let msg = '{{ app()->getLocale() === 'sw' ? 'Habari, nataka kujiunga na huduma ya' : 'Hello, I want to join' }}: ' + ministry + '\n{{ app()->getLocale() === 'sw' ? 'Jina' : 'Name' }}: ' + $refs.mName.value + '\n{{ app()->getLocale() === 'sw' ? 'Simu' : 'Phone' }}: ' + $refs.mPhone.value + '\n{{ app()->getLocale() === 'sw' ? 'Ujumbe' : 'Message' }}: ' + $refs.mMessage.value;
                            window.open('https://wa.me/255784363502?text=' + encodeURIComponent(msg), '_blank');
                            open = false;
                        "
                        style="background-color: #25D366;"
                        class="px-6 py-4 text-white font-bold rounded-xl hover:opacity-90 transition shadow-lg flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    WhatsApp
                </button>
                <button type="button"
                        x-on:click="
                            let subject = '{{ app()->getLocale() === 'sw' ? 'Kujiunga na Huduma' : 'Join Ministry' }}: ' + ministry;
                            let body = '{{ app()->getLocale() === 'sw' ? 'Jina' : 'Name' }}: ' + $refs.mName.value + '\n{{ app()->getLocale() === 'sw' ? 'Simu' : 'Phone' }}: ' + $refs.mPhone.value + '\n{{ app()->getLocale() === 'sw' ? 'Barua Pepe' : 'Email' }}: ' + $refs.mEmail.value + '\n{{ app()->getLocale() === 'sw' ? 'Ujumbe' : 'Message' }}: ' + $refs.mMessage.value;
                            window.location.href = 'mailto:info@ndpccenter.co.tz?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);
                            open = false;
                        "
                        class="px-6 py-4 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition shadow-lg flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Email
                </button>
            </div>
        </div>

        <p class="text-center text-xs text-gray-400 mt-4">{{ app()->getLocale() === 'sw' ? 'Chagua njia unayopendelea kutuma ujumbe wako.' : 'Choose your preferred way to send your message.' }}</p>
    </div>
</div>
@endsection
