@php
    $locale = request()->route('locale') ?? app()->getLocale();
    $otherLocale = $locale === 'en' ? 'sw' : 'en';
@endphp

<header id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-transparent transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- Brand (Left) --}}
            <a href="{{ route('home', $locale) }}" class="flex items-center gap-3 shrink-0">
                <img src="{{ asset('images/ndpcc-logo.png') }}" alt="NDPCC Logo" class="h-12 w-auto">
                <div class="hidden sm:block">
                    <span class="block text-lg font-bold text-white leading-tight">NDPCC</span>
                    <span class="block text-[11px] text-white/70 leading-tight">Nayoth Divine Power Christian Centre</span>
                </div>
            </a>

            {{-- Desktop Nav (Center) --}}
            <nav class="hidden lg:flex items-center gap-5 mx-8">
                <a href="{{ route('home', $locale) }}" class="text-sm text-white/90 hover:text-gold font-medium transition whitespace-nowrap">{{ __('site.nav.home') }}</a>
                <a href="{{ route('about', $locale) }}" class="text-sm text-white/90 hover:text-gold font-medium transition whitespace-nowrap">{{ __('site.nav.about') }}</a>
                <a href="{{ route('sermons', $locale) }}" class="text-sm text-white/90 hover:text-gold font-medium transition whitespace-nowrap">{{ __('site.nav.sermons') }}</a>
                <a href="{{ route('radio', $locale) }}" class="text-sm text-white/90 hover:text-gold font-medium transition whitespace-nowrap">{{ __('site.nav.radio') }}</a>
                <a href="{{ route('events', $locale) }}" class="text-sm text-white/90 hover:text-gold font-medium transition whitespace-nowrap">{{ __('site.nav.events') }}</a>
                <a href="{{ route('ministries', $locale) }}" class="text-sm text-white/90 hover:text-gold font-medium transition whitespace-nowrap">{{ __('site.nav.ministries') }}</a>
                <a href="{{ route('foundation', $locale) }}" class="text-sm text-white/90 hover:text-gold font-medium transition whitespace-nowrap">{{ __('site.nav.foundation') }}</a>
                <a href="{{ route('contact', $locale) }}" class="text-sm text-white/90 hover:text-gold font-medium transition whitespace-nowrap">{{ __('site.nav.contact') }}</a>
            </nav>

            {{-- Actions (Right) --}}
            <div class="flex items-center gap-3 shrink-0">
                {{-- Language Switch --}}
                <a href="{{ route('lang.switch', $otherLocale) }}"
                   class="px-3 py-1.5 border border-gold text-gold text-sm font-semibold rounded hover:bg-gold hover:text-white transition">
                    {{ $otherLocale === 'sw' ? 'SW' : 'EN' }}
                </a>

                {{-- Give Button --}}
                <a href="{{ route('give', $locale) }}"
                   class="hidden sm:inline-flex px-4 py-2 bg-gold text-white text-sm font-semibold rounded hover:bg-gold-light transition">
                    {{ __('site.nav.give') }}
                </a>

                {{-- Mobile Menu Toggle --}}
                <button x-data x-on:click="$dispatch('toggle-mobile-menu')"
                        class="lg:hidden text-white p-2" aria-label="Menu">
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
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         x-cloak
         class="lg:hidden bg-primary-dark/95 backdrop-blur-md border-t border-white/10">
        <div class="px-6 py-4 space-y-1">
            <a href="{{ route('home', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.home') }}</a>
            <a href="{{ route('about', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.about') }}</a>
            <a href="{{ route('sermons', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.sermons') }}</a>
            <a href="{{ route('radio', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.radio') }}</a>
            <a href="{{ route('events', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.events') }}</a>
            <a href="{{ route('ministries', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.ministries') }}</a>
            <a href="{{ route('foundation', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.foundation') }}</a>
            <a href="{{ route('give', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.give') }}</a>
            <a href="{{ route('contact', $locale) }}" class="block py-2.5 text-white/90 hover:text-gold font-medium">{{ __('site.nav.contact') }}</a>
            <div class="pt-3 border-t border-white/10">
                <a href="{{ route('lang.switch', $otherLocale) }}" class="inline-block px-4 py-2 border border-gold text-gold text-sm font-semibold rounded hover:bg-gold hover:text-white transition">
                    {{ $otherLocale === 'sw' ? 'Swahili' : 'English' }}
                </a>
            </div>
        </div>
    </div>
</header>
