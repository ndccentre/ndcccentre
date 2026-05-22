@php
    $locale = request()->route('locale') ?? app()->getLocale();
    $otherLocale = $locale === 'en' ? 'sw' : 'en';
@endphp

{{-- Top Ribbon: Phone, Email, Radio, Blog, Social, Language --}}
<div class="bg-primary-dark text-white py-2 hidden md:block fixed top-0 @auth top-[28px] @endauth left-0 right-0 z-[60]">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
        <div class="flex items-center gap-5 text-sm">
            <a href="tel:+255784363502" class="flex items-center gap-2 hover:text-gold transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                +255 784 363 502
            </a>
            <a href="mailto:info@ndpccenter.co.tz" class="flex items-center gap-2 hover:text-gold transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                info@ndpccenter.co.tz
            </a>
            <a href="{{ route('radio', $locale) }}" class="flex items-center gap-2 hover:text-gold transition text-gold font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728M9.172 15.828a5 5 0 010-7.072m5.656 0a5 5 0 010 7.072M12 12h.01"/></svg>
                {{ app()->getLocale() === 'sw' ? 'Redio' : 'Radio' }}
            </a>
            <a href="{{ route('blog', $locale) }}" class="flex items-center gap-2 hover:text-gold transition text-white/90 font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                Blog
            </a>
        </div>
        <div class="flex items-center gap-3">
            <a href="https://www.youtube.com/@ApostleMathayonnko" target="_blank" rel="noopener" class="w-7 h-7 flex items-center justify-center rounded-full bg-white/10 hover:bg-red-600 transition" aria-label="YouTube"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
            <a href="https://www.facebook.com/NayothMinistry" target="_blank" rel="noopener" class="w-7 h-7 flex items-center justify-center rounded-full bg-white/10 hover:bg-blue-600 transition" aria-label="Facebook"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
            <a href="https://www.instagram.com/apostlemathayonnko" target="_blank" rel="noopener" class="w-7 h-7 flex items-center justify-center rounded-full bg-white/10 hover:bg-pink-600 transition" aria-label="Instagram"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
            <a href="https://www.tiktok.com/@apostlemathayonnko" target="_blank" rel="noopener" class="w-7 h-7 flex items-center justify-center rounded-full bg-white/10 hover:bg-gray-700 transition" aria-label="TikTok"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg></a>
            <span class="w-px h-4 bg-white/30 mx-1"></span>
            <a href="{{ route('lang.switch', $otherLocale) }}" class="px-3 py-1 border border-gold text-gold text-xs font-bold rounded hover:bg-gold hover:text-white transition uppercase">
                {{ strtoupper($otherLocale) }}
            </a>
        </div>
    </div>
</div>

{{-- Main Header: Logo, Menu (right-aligned), Give --}}
<header id="navbar" class="fixed top-0 md:top-[36px] @auth md:top-[64px] @endauth left-0 right-0 z-50 bg-dark/95 backdrop-blur-md shadow-lg transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-16">

            {{-- Left: Logo + Church Name --}}
            <a href="{{ route('home', $locale) }}" class="flex items-center gap-3 shrink-0">
                <img src="{{ asset('images/ndpcc-logo.png') }}" alt="NDPCC" class="h-10 w-auto">
                <div class="hidden sm:block leading-tight">
                    <span class="block text-base font-bold text-white">NDPCC</span>
                    <span class="block text-[11px] text-white/60">Nayoth Divine Power Christian Centre</span>
                </div>
            </a>

            {{-- Right: Navigation + Give --}}
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home', $locale) }}" class="px-3 py-2 text-sm text-white/90 hover:text-gold font-medium transition">{{ __('site.nav.home') }}</a>
                <a href="{{ route('about', $locale) }}" class="px-3 py-2 text-sm text-white/90 hover:text-gold font-medium transition">{{ __('site.nav.about') }}</a>
                <a href="{{ route('sermons', $locale) }}" class="px-3 py-2 text-sm text-white/90 hover:text-gold font-medium transition">{{ __('site.nav.sermons') }}</a>
                <a href="{{ route('events', $locale) }}" class="px-3 py-2 text-sm text-white/90 hover:text-gold font-medium transition">{{ __('site.nav.events') }}</a>
                <a href="{{ route('ministries', $locale) }}" class="px-3 py-2 text-sm text-white/90 hover:text-gold font-medium transition">{{ __('site.nav.ministries') }}</a>
                <a href="{{ route('foundation', $locale) }}" class="px-3 py-2 text-sm text-white/90 hover:text-gold font-medium transition">{{ __('site.nav.foundation') }}</a>
                <a href="{{ route('prayer', $locale) }}" class="px-3 py-2 text-sm text-white/90 hover:text-gold font-medium transition">{{ __('site.nav.prayer') }}</a>
                <a href="{{ route('contact', $locale) }}" class="px-3 py-2 text-sm text-white/90 hover:text-gold font-medium transition">{{ __('site.nav.contact') }}</a>
                <a href="{{ route('give', $locale) }}"
                   class="ml-3 px-5 py-2 bg-gold text-white text-sm font-bold rounded-lg hover:bg-gold-light transition">
                    {{ app()->getLocale() === 'sw' ? 'Toa Sadaka' : 'Give an Offering' }}
                </a>
            </div>

            {{-- Mobile: Language + Hamburger --}}
            <div class="flex items-center gap-2 lg:hidden">
                <a href="{{ route('lang.switch', $otherLocale) }}"
                   class="md:hidden px-2.5 py-1 border border-gold text-gold text-xs font-bold rounded hover:bg-gold hover:text-white transition uppercase">
                    {{ strtoupper($otherLocale) }}
                </a>
                <button x-data x-on:click="$dispatch('toggle-mobile-menu')"
                        class="text-white p-2" aria-label="Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-data="{ open: false }"
         x-on:toggle-mobile-menu.window="open = !open"
         x-show="open"
         x-transition
         x-cloak
         class="lg:hidden bg-dark/98 backdrop-blur-md border-t border-white/10">
        <div class="px-6 py-4 space-y-1">
            <a href="{{ route('home', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.home') }}</a>
            <a href="{{ route('about', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.about') }}</a>
            <a href="{{ route('sermons', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.sermons') }}</a>
            <a href="{{ route('radio', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.radio') }}</a>
            <a href="{{ route('events', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.events') }}</a>
            <a href="{{ route('ministries', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.ministries') }}</a>
            <a href="{{ route('foundation', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.foundation') }}</a>
            <a href="{{ route('prayer', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.prayer') }}</a>
            <a href="{{ route('contact', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.contact') }}</a>
            <div class="pt-3 mt-2 border-t border-white/10">
                <a href="{{ route('give', $locale) }}" class="inline-block px-6 py-2.5 bg-gold text-white font-bold rounded-lg">
                    {{ app()->getLocale() === 'sw' ? 'Toa Sadaka' : 'Give an Offering' }}
                </a>
            </div>
        </div>
    </div>
</header>
