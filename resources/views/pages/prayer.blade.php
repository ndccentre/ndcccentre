@extends('layouts.app')
@section('title', __('site.prayer.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-40 bg-dark overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/90 via-dark/80 to-dark"></div>
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 left-1/3 w-80 h-80 bg-gold rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-1/4 w-64 h-64 bg-primary rounded-full blur-3xl"></div>
    </div>
    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-2 bg-gold/20 text-gold text-sm font-semibold rounded-full mb-6" data-aos="fade-up">
            {{ app()->getLocale() === 'sw' ? 'Tunaomba Pamoja Nawe' : 'We Pray With You' }}
        </span>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6" data-aos="fade-up" data-aos-delay="100">{{ __('site.prayer.title') }}</h1>
        <p class="text-xl text-white/70 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">{{ __('site.prayer.subtitle') }}</p>
    </div>
</section>

{{-- Bible Verse --}}
<section class="py-12 bg-gold/10" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <blockquote class="text-xl md:text-2xl font-serif italic text-gray-700 leading-relaxed">
            {{ app()->getLocale() === 'sw' ? '"Msiwe na wasiwasi kwa jambo lo lote; bali katika kila neno kwa kusali na kuomba, pamoja na kushukuru, haja zenu na zijulikane na Mungu."' : '"Do not be anxious about anything, but in every situation, by prayer and petition, with thanksgiving, present your requests to God."' }}
        </blockquote>
        <p class="text-gold font-semibold mt-4">— {{ app()->getLocale() === 'sw' ? 'Wafilipi 4:6' : 'Philippians 4:6' }}</p>
    </div>
</section>

{{-- Encouraging Words + Form --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-16">

        {{-- Left: Encouraging Words --}}
        <div data-aos="fade-right">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ app()->getLocale() === 'sw' ? 'Mungu Anakusikia' : 'God Hears You' }}</h2>
            <p class="text-gray-600 leading-relaxed mb-6">
                {{ app()->getLocale() === 'sw' ? 'Haijalishi unachopitia — ugonjwa, changamoto za kifedha, mahusiano, au mzigo wowote — Mungu anakusikia. Timu yetu ya maombi iko tayari kusimama pamoja nawe katika imani.' : 'No matter what you are going through — illness, financial challenges, relationships, or any burden — God hears you. Our prayer team is ready to stand with you in faith.' }}
            </p>

            <div class="space-y-4 mb-8">
                <div class="flex items-start gap-3 p-4 bg-gray-soft rounded-xl">
                    <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">{{ app()->getLocale() === 'sw' ? 'Upendo wa Mungu' : 'God\'s Love' }}</p>
                        <p class="text-sm text-gray-600">{{ app()->getLocale() === 'sw' ? '"Kwa maana Mungu aliupenda ulimwengu hata akamtoa Mwanawe pekee" — Yohana 3:16' : '"For God so loved the world that He gave His only Son" — John 3:16' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-4 bg-gray-soft rounded-xl">
                    <div class="w-10 h-10 bg-gold/10 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">{{ app()->getLocale() === 'sw' ? 'Ahadi Yake' : 'His Promise' }}</p>
                        <p class="text-sm text-gray-600">{{ app()->getLocale() === 'sw' ? '"Ombeni, nanyi mtapewa; tafuteni, nanyi mtaona" — Mathayo 7:7' : '"Ask and it will be given to you; seek and you will find" — Matthew 7:7' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-4 bg-gray-soft rounded-xl">
                    <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">{{ app()->getLocale() === 'sw' ? 'Amani Yake' : 'His Peace' }}</p>
                        <p class="text-sm text-gray-600">{{ app()->getLocale() === 'sw' ? '"Amani ya Mungu ipitayo akili zote itawahifadhi mioyo yenu" — Wafilipi 4:7' : '"The peace of God, which surpasses all understanding, will guard your hearts" — Philippians 4:7' }}</p>
                    </div>
                </div>
            </div>

            {{-- Contact for Prayer --}}
            <div class="bg-gradient-to-r from-primary-dark to-primary rounded-2xl p-6 text-white">
                <h3 class="font-bold text-lg mb-2">{{ app()->getLocale() === 'sw' ? 'Kwa Maombi ya Haraka' : 'For Urgent Prayer' }}</h3>
                <p class="text-white/70 text-sm mb-4">{{ app()->getLocale() === 'sw' ? 'Piga simu au tuma WhatsApp moja kwa moja:' : 'Call or WhatsApp us directly:' }}</p>
                <a href="tel:+255784363502" class="inline-flex items-center gap-2 text-gold font-bold hover:text-gold-light transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    +255 784 363 502
                </a>
            </div>
        </div>

        {{-- Right: Prayer Request Form --}}
        <div data-aos="fade-left">
            <div class="bg-gray-soft rounded-2xl p-8 md:p-10 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ app()->getLocale() === 'sw' ? 'Tuma Ombi Lako' : 'Submit Your Request' }}</h2>
                <p class="text-gray-500 text-sm mb-8">{{ app()->getLocale() === 'sw' ? 'Timu yetu itaomba kwa ajili yako ndani ya masaa 24.' : 'Our team will pray for you within 24 hours.' }}</p>

                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-medium flex items-center gap-2">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ __('site.prayer.success') }}
                </div>
                @endif

                <form method="POST" action="{{ route('prayer.store', request()->route('locale') ?? 'en') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('site.prayer.form_name') }} *</label>
                        <input type="text" name="name" required
                               class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition"
                               placeholder="{{ app()->getLocale() === 'sw' ? 'Jina lako kamili' : 'Your full name' }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('site.prayer.form_email') }}</label>
                        <input type="email" name="email"
                               class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition"
                               placeholder="{{ app()->getLocale() === 'sw' ? 'Barua pepe yako' : 'Your email address' }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('site.prayer.form_request') }} *</label>
                        <textarea name="request" rows="5" required
                                  class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition resize-none"
                                  placeholder="{{ app()->getLocale() === 'sw' ? 'Andika ombi lako hapa... Tunakusikia.' : 'Write your prayer request here... We hear you.' }}"></textarea>
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="is_public" value="1" id="is_public"
                               class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                        <label for="is_public" class="text-sm text-gray-600">{{ __('site.prayer.form_public') }}</label>
                    </div>
                    <button type="submit"
                            class="w-full px-8 py-4 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition shadow-lg text-lg">
                        {{ __('site.prayer.form_submit') }}
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>

{{-- Prayer Wall --}}
@if($publicRequests->count())
<section class="py-20 bg-gray-soft">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Tunaomba Pamoja' : 'Praying Together' }}</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-3">{{ __('site.prayer.wall_title') }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($publicRequests as $req)
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="{{ $loop->index % 6 * 50 }}">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                        <span class="text-primary font-bold text-sm">{{ strtoupper(substr($req->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">{{ $req->name }}</p>
                        <p class="text-xs text-gray-400">{{ $req->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed">{{ Str::limit($req->request, 150) }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Bottom Scripture --}}
<section class="py-16 bg-gradient-to-r from-primary-dark to-primary text-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <blockquote class="text-xl md:text-2xl font-serif italic leading-relaxed">
            {{ app()->getLocale() === 'sw' ? '"Bwana yu karibu na wote wamwitao, wote wamwitao kwa uaminifu."' : '"The Lord is near to all who call on Him, to all who call on Him in truth."' }}
        </blockquote>
        <p class="mt-4 text-gold font-semibold">— {{ app()->getLocale() === 'sw' ? 'Zaburi 145:18' : 'Psalm 145:18' }}</p>
    </div>
</section>
@endsection
