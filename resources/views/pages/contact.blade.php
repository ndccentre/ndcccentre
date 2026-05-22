@extends('layouts.app')
@section('title', __('site.contact.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-40 bg-dark overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/90 via-dark/80 to-dark"></div>
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 right-1/4 w-72 h-72 bg-gold rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 left-1/3 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
    </div>
    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-2 bg-gold/20 text-gold text-sm font-semibold rounded-full mb-6" data-aos="fade-up">
            {{ app()->getLocale() === 'sw' ? 'Karibu Sana' : 'Welcome' }}
        </span>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6" data-aos="fade-up" data-aos-delay="100">{{ __('site.contact.title') }}</h1>
        <p class="text-xl text-white/70 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">{{ __('site.contact.subtitle') }}</p>
    </div>
</section>

{{-- Contact Cards --}}
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            @if($phone)
            <div class="bg-gray-soft rounded-2xl p-6 text-center hover:-translate-y-1 transition-transform" data-aos="fade-up">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <h4 class="font-bold text-gray-900 mb-1">{{ __('site.contact.phone') }}</h4>
                <a href="tel:{{ $phone }}" class="text-primary hover:underline text-sm">{{ $phone }}</a>
            </div>
            @endif
            @if($whatsapp)
            <div class="bg-gray-soft rounded-2xl p-6 text-center hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-delay="50">
                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </div>
                <h4 class="font-bold text-gray-900 mb-1">WhatsApp</h4>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" target="_blank" class="text-green-600 hover:underline text-sm">{{ $whatsapp }}</a>
            </div>
            @endif
            @if($email)
            <div class="bg-gray-soft rounded-2xl p-6 text-center hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-delay="100">
                <div class="w-14 h-14 bg-gold/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h4 class="font-bold text-gray-900 mb-1">{{ __('site.contact.email') }}</h4>
                <a href="mailto:{{ $email }}" class="text-gold hover:underline text-sm">{{ $email }}</a>
            </div>
            @endif
            @if($address)
            <div class="bg-gray-soft rounded-2xl p-6 text-center hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-delay="150">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h4 class="font-bold text-gray-900 mb-1">{{ __('site.contact.address') }}</h4>
                <p class="text-gray-600 text-sm">{{ $address }}</p>
            </div>
            @endif
        </div>

        {{-- Form + Map --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- Contact Form --}}
            <div data-aos="fade-right">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ app()->getLocale() === 'sw' ? 'Tuandikie Ujumbe' : 'Send Us a Message' }}</h2>
                <form action="mailto:info@ndpccenter.co.tz" method="POST" enctype="text/plain" class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ app()->getLocale() === 'sw' ? 'Jina' : 'Name' }} *</label>
                            <input type="text" name="name" required
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                   placeholder="{{ app()->getLocale() === 'sw' ? 'Jina lako' : 'Your name' }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ app()->getLocale() === 'sw' ? 'Barua Pepe' : 'Email' }} *</label>
                            <input type="email" name="email" required
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                   placeholder="{{ app()->getLocale() === 'sw' ? 'Barua pepe' : 'Your email' }}">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ app()->getLocale() === 'sw' ? 'Mada' : 'Subject' }}</label>
                        <input type="text" name="subject"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition"
                               placeholder="{{ app()->getLocale() === 'sw' ? 'Mada ya ujumbe' : 'Subject' }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ app()->getLocale() === 'sw' ? 'Ujumbe' : 'Message' }} *</label>
                        <textarea name="message" rows="5" required
                                  class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition resize-none"
                                  placeholder="{{ app()->getLocale() === 'sw' ? 'Andika ujumbe wako...' : 'Write your message...' }}"></textarea>
                    </div>
                    <button type="submit"
                            class="w-full px-8 py-4 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition shadow-lg text-lg">
                        {{ app()->getLocale() === 'sw' ? 'Tuma Ujumbe' : 'Send Message' }}
                    </button>
                </form>
            </div>

            {{-- Map + Service Times --}}
            <div data-aos="fade-left">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ app()->getLocale() === 'sw' ? 'Tukutane' : 'Find Us' }}</h2>
                <div class="rounded-2xl overflow-hidden shadow-lg h-72 mb-8">
                    @php $mapEmbed = \App\Models\SiteSetting::get('map_embed_url'); @endphp
                    <iframe
                        src="{{ $mapEmbed ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127642.94!2d36.63!3d-3.3869!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x18371b50e0f5c7c7%3A0x5c0f1c0f1c0f1c0f!2sArusha%2C%20Tanzania!5e0!3m2!1sen!2stz!4v1' }}"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                @if($serviceTimes)
                <div class="bg-gradient-to-r from-primary-dark to-primary rounded-2xl p-6 text-white">
                    <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ __('site.contact.service_times') }}
                    </h3>
                    <p class="text-white/80 whitespace-pre-line leading-relaxed">{{ $serviceTimes }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- Quick Links --}}
<section class="py-16 bg-gray-soft" data-aos="fade-up">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-gray-900">{{ app()->getLocale() === 'sw' ? 'Viungo vya Haraka' : 'Quick Links' }}</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('prayer', request()->route('locale') ?? 'en') }}" class="bg-white rounded-xl p-5 text-center shadow-sm border border-gray-100 hover:-translate-y-1 hover:shadow-md transition-all">
                <svg class="w-8 h-8 text-primary mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                <span class="text-sm font-semibold text-gray-900">{{ __('site.nav.prayer') }}</span>
            </a>
            <a href="{{ route('give', request()->route('locale') ?? 'en') }}" class="bg-white rounded-xl p-5 text-center shadow-sm border border-gray-100 hover:-translate-y-1 hover:shadow-md transition-all">
                <svg class="w-8 h-8 text-gold mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-sm font-semibold text-gray-900">{{ app()->getLocale() === 'sw' ? 'Toa Sadaka' : 'Give an Offering' }}</span>
            </a>
            <a href="{{ route('sermons', request()->route('locale') ?? 'en') }}" class="bg-white rounded-xl p-5 text-center shadow-sm border border-gray-100 hover:-translate-y-1 hover:shadow-md transition-all">
                <svg class="w-8 h-8 text-primary mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                <span class="text-sm font-semibold text-gray-900">{{ __('site.nav.sermons') }}</span>
            </a>
            <a href="{{ route('events', request()->route('locale') ?? 'en') }}" class="bg-white rounded-xl p-5 text-center shadow-sm border border-gray-100 hover:-translate-y-1 hover:shadow-md transition-all">
                <svg class="w-8 h-8 text-gold mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span class="text-sm font-semibold text-gray-900">{{ __('site.nav.events') }}</span>
            </a>
        </div>
    </div>
</section>

{{-- Social CTA --}}
<section class="py-16 bg-gradient-to-r from-primary-dark to-primary text-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-2xl md:text-3xl font-bold mb-4">{{ app()->getLocale() === 'sw' ? 'Tufuatilie Mitandaoni' : 'Follow Us Online' }}</h2>
        <p class="text-white/70 mb-8">{{ app()->getLocale() === 'sw' ? 'Jiunge na familia yetu kwenye mitandao ya kijamii.' : 'Join our family on social media.' }}</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="https://www.youtube.com/@ApostleMathayonnko" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 text-white font-semibold rounded-xl hover:bg-red-600 transition border border-white/20">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                YouTube
            </a>
            <a href="https://www.facebook.com/NayothMinistry" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 text-white font-semibold rounded-xl hover:bg-blue-600 transition border border-white/20">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                Facebook
            </a>
            <a href="https://www.instagram.com/apostlemathayonnko" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 text-white font-semibold rounded-xl hover:bg-pink-600 transition border border-white/20">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                Instagram
            </a>
            <a href="https://www.tiktok.com/@apostlemathayonnko" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 text-white font-semibold rounded-xl hover:bg-gray-700 transition border border-white/20">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                TikTok
            </a>
        </div>
    </div>
</section>
@endsection
