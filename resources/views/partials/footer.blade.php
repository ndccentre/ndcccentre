@php
    $locale = request()->route('locale') ?? app()->getLocale();
@endphp

<footer class="bg-dark text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            {{-- Brand --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/ndpcc-logo.png') }}" alt="NDPCC" class="h-12 w-auto">
                    <span class="text-xl font-bold text-gold">NDPCC</span>
                </div>
                <p class="text-white/70 text-sm leading-relaxed">
                    {{ __('site.footer.tagline') }}
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-gold font-semibold mb-4">{{ __('site.footer.links_title') }}</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('about', $locale) }}" class="text-white/70 hover:text-gold transition">{{ __('site.nav.about') }}</a></li>
                    <li><a href="{{ route('sermons', $locale) }}" class="text-white/70 hover:text-gold transition">{{ __('site.nav.sermons') }}</a></li>
                    <li><a href="{{ route('events', $locale) }}" class="text-white/70 hover:text-gold transition">{{ __('site.nav.events') }}</a></li>
                    <li><a href="{{ route('foundation', $locale) }}" class="text-white/70 hover:text-gold transition">{{ __('site.nav.foundation') }}</a></li>
                    <li><a href="{{ route('give', $locale) }}" class="text-white/70 hover:text-gold transition">{{ __('site.nav.give') }}</a></li>
                    <li><a href="{{ route('contact', $locale) }}" class="text-white/70 hover:text-gold transition">{{ __('site.nav.contact') }}</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-gold font-semibold mb-4">{{ __('site.footer.contact_title') }}</h4>
                <ul class="space-y-2 text-sm text-white/70">
                    @if($address = \App\Models\SiteSetting::get('contact_address'))
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{{ $address }}</span>
                        </li>
                    @endif
                    @if($phone = \App\Models\SiteSetting::get('contact_phone'))
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>{{ $phone }}</span>
                        </li>
                    @endif
                    @if($email = \App\Models\SiteSetting::get('contact_email'))
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>{{ $email }}</span>
                        </li>
                    @endif
                </ul>
            </div>

        </div>

        {{-- Copyright --}}
        <div class="mt-12 pt-8 border-t border-white/10 text-center text-sm text-white/50">
            &copy; {{ date('Y') }} NDPCC. {{ __('site.footer.rights') }}
        </div>
    </div>
</footer>
