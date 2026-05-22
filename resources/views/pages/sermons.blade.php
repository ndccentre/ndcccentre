@extends('layouts.app')
@section('title', __('site.sermons.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-40 bg-dark overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/90 via-dark/80 to-dark"></div>
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 right-10 w-80 h-80 bg-gold rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 left-20 w-64 h-64 bg-primary rounded-full blur-3xl"></div>
    </div>
    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-2 bg-gold/20 text-gold text-sm font-semibold rounded-full mb-6" data-aos="fade-up">
            {{ app()->getLocale() === 'sw' ? 'Neno la Mungu' : 'The Word of God' }}
        </span>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6" data-aos="fade-up" data-aos-delay="100">{{ __('site.sermons.title') }}</h1>
        <p class="text-xl text-white/70 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            {{ app()->getLocale() === 'sw' ? 'Tazama mahubiri, shorts, na ibada za moja kwa moja kutoka kwa Mtume Mathayo Nnko.' : 'Watch sermons, shorts, and live services from Apostle Mathayo Nnko.' }}
        </p>
        <div class="mt-8 flex flex-wrap justify-center gap-4" data-aos="fade-up" data-aos-delay="300">
            <a href="https://www.youtube.com/@ApostleMathayonnko" target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                {{ app()->getLocale() === 'sw' ? 'Tazama YouTube' : 'Watch on YouTube' }}
            </a>
        </div>
    </div>
</section>

{{-- Tabs Navigation --}}
<section class="bg-white border-b sticky top-[52px] md:top-[88px] z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4">
        <nav class="flex gap-1" id="sermon-tabs" role="tablist">
            <button type="button" role="tab" aria-selected="true" aria-controls="panel-sermons"
                    class="tab-btn active px-6 py-4 text-sm font-semibold border-b-3 border-primary text-primary transition"
                    data-tab="sermons">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    {{ __('site.sermons.tab_sermons') }}
                </span>
            </button>
            <button type="button" role="tab" aria-selected="false" aria-controls="panel-shorts"
                    class="tab-btn px-6 py-4 text-sm font-semibold border-b-3 border-transparent text-gray-500 hover:text-primary transition"
                    data-tab="shorts">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    {{ __('site.sermons.tab_shorts') }}
                </span>
            </button>
            <button type="button" role="tab" aria-selected="false" aria-controls="panel-live"
                    class="tab-btn px-6 py-4 text-sm font-semibold border-b-3 border-transparent text-gray-500 hover:text-primary transition"
                    data-tab="live">
                <span class="flex items-center gap-2">
                    @if($isLive)
                    <span class="w-2.5 h-2.5 bg-red-500 rounded-full animate-pulse"></span>
                    @else
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728M9.172 15.828a5 5 0 010-7.072m5.656 0a5 5 0 010 7.072M12 12h.01"/></svg>
                    @endif
                    {{ __('site.sermons.tab_live') }}
                </span>
            </button>
        </nav>
    </div>
</section>

{{-- Tab 1: Sermons --}}
<section id="panel-sermons" class="tab-panel py-16 bg-gray-soft" role="tabpanel">
    <div class="max-w-7xl mx-auto px-4">
        @php
            $allSermons = $youtubeSermons->map(function($v) {
                return (object) $v;
            })->merge($manualSermons->map(function($s) {
                return (object) [
                    'video_id' => $s->youtube_video_id,
                    'title' => app()->getLocale() === 'sw' ? $s->title_sw : $s->title_en,
                    'thumbnail' => $s->thumbnail_url ?? ($s->youtube_video_id ? "https://img.youtube.com/vi/{$s->youtube_video_id}/maxresdefault.jpg" : null),
                    'published_at' => $s->preached_at ? $s->preached_at->format('Y-m-d') : null,
                    'duration_str' => $s->duration ?? '',
                    'view_count' => $s->view_count ?? 0,
                    'embed_url' => $s->youtube_video_id ? "https://www.youtube.com/embed/{$s->youtube_video_id}" : ($s->youtube_url ?? ''),
                    'watch_url' => $s->youtube_video_id ? "https://www.youtube.com/watch?v={$s->youtube_video_id}" : ($s->youtube_url ?? ''),
                    'speaker' => $s->speaker,
                    'source' => 'manual',
                ];
            }))->sortByDesc('published_at')->values();
        @endphp

        @if($allSermons->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($allSermons as $video)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index % 6 * 50 }}">
                <div class="relative h-52 bg-gray-200 overflow-hidden group">
                    @if($video->thumbnail)
                    <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                        <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </div>
                    @endif
                    @if($video->embed_url)
                    <a href="{{ $video->embed_url }}" class="glightbox absolute inset-0 flex items-center justify-center bg-black/0 group-hover:bg-black/40 transition-all duration-300">
                        <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center shadow-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform group-hover:scale-100 scale-75">
                            <svg class="w-7 h-7 text-primary ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </a>
                    @endif
                    @if($video->duration_str)
                    <span class="absolute bottom-3 right-3 bg-black/80 text-white text-xs px-2 py-1 rounded-md font-medium">{{ $video->duration_str }}</span>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 leading-snug">{{ $video->title }}</h3>
                    @if(!empty($video->speaker))
                    <p class="text-sm text-gray-500 mb-2">{{ $video->speaker }}</p>
                    @endif
                    <div class="flex items-center justify-between text-xs text-gray-400 mt-3 pt-3 border-t border-gray-100">
                        @if($video->published_at)
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ \Carbon\Carbon::parse($video->published_at)->format('M d, Y') }}
                        </span>
                        @endif
                        @if($video->view_count > 0)
                        <span>{{ number_format($video->view_count) }} {{ __('site.sermons.views') }}</span>
                        @endif
                    </div>
                    @if($video->watch_url)
                    <a href="{{ $video->watch_url }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-1 mt-4 text-sm text-primary font-semibold hover:text-primary-dark transition">
                        {{ __('site.sermons.watch_youtube') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            </div>
            <p class="text-gray-500 text-lg">{{ __('site.sermons.no_results') }}</p>
        </div>
        @endif
    </div>
</section>

{{-- Tab 2: Shorts --}}
<section id="panel-shorts" class="tab-panel py-16 bg-gray-soft hidden" role="tabpanel">
    <div class="max-w-7xl mx-auto px-4">
        @if($shorts->count())
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach($shorts as $video)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index % 8 * 50 }}">
                <div class="relative aspect-[9/16] bg-gray-200 overflow-hidden group">
                    <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    <a href="{{ $video['embed_url'] }}" class="glightbox absolute inset-0 flex items-center justify-center bg-black/0 group-hover:bg-black/40 transition-all duration-300">
                        <div class="w-14 h-14 bg-white/90 rounded-full flex items-center justify-center shadow-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-6 h-6 text-red-500 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </a>
                    <span class="absolute top-3 left-3 px-2 py-0.5 bg-red-500 text-white text-[10px] font-bold rounded uppercase">Short</span>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-sm text-gray-900 line-clamp-2">{{ $video['title'] }}</h3>
                    <p class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($video['published_at'])->format('M d, Y') }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            </div>
            <p class="text-gray-500 text-lg">{{ __('site.sermons.no_shorts') }}</p>
        </div>
        @endif
    </div>
</section>

{{-- Tab 3: Live --}}
<section id="panel-live" class="tab-panel py-16 bg-gray-soft hidden" role="tabpanel">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Live Now Banner --}}
        @if($isLive && $liveVideoId)
        <div class="mb-12 bg-gradient-to-r from-red-600 to-red-700 rounded-3xl p-8 md:p-10 shadow-2xl" data-aos="fade-up">
            <div class="flex items-center gap-3 mb-6">
                <span class="inline-flex items-center gap-2 bg-white/20 text-white text-sm font-bold px-4 py-2 rounded-full">
                    <span class="w-2.5 h-2.5 bg-white rounded-full animate-pulse"></span>
                    {{ __('site.sermons.live_badge') }}
                </span>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-2xl">
                <iframe
                    src="https://www.youtube.com/embed/{{ $liveVideoId }}?autoplay=0&rel=0"
                    width="100%"
                    style="aspect-ratio: 16/9; border: none;"
                    allowfullscreen
                    title="Live Stream">
                </iframe>
            </div>
        </div>
        @endif

        {{-- Past Live Recordings --}}
        @if($lives->count())
        <h2 class="text-2xl font-bold text-gray-900 mb-8" data-aos="fade-up">{{ __('site.sermons.past_live') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($lives as $video)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300" data-aos="fade-up">
                <div class="relative h-48 bg-gray-200 overflow-hidden group">
                    <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    <a href="{{ $video['embed_url'] }}" class="glightbox absolute inset-0 flex items-center justify-center bg-black/0 group-hover:bg-black/40 transition-all duration-300">
                        <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center shadow-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-7 h-7 text-primary ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </a>
                    @if($video['duration_str'])
                    <span class="absolute bottom-3 right-3 bg-black/80 text-white text-xs px-2 py-1 rounded-md">{{ $video['duration_str'] }}</span>
                    @endif
                    <span class="absolute top-3 left-3 px-2 py-0.5 bg-red-500/90 text-white text-[10px] font-bold rounded uppercase">Live</span>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">{{ $video['title'] }}</h3>
                    <div class="flex items-center justify-between text-xs text-gray-400 mt-3">
                        <span>{{ \Carbon\Carbon::parse($video['published_at'])->format('M d, Y') }}</span>
                        @if($video['view_count'] > 0)
                        <span>{{ number_format($video['view_count']) }} {{ __('site.sermons.views') }}</span>
                        @endif
                    </div>
                    <a href="{{ $video['watch_url'] }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-1 mt-4 text-sm text-primary font-semibold hover:text-primary-dark transition">
                        {{ __('site.sermons.watch_youtube') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @elseif(!$isLive)
        <div class="text-center py-16">
            <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728M9.172 15.828a5 5 0 010-7.072m5.656 0a5 5 0 010 7.072M12 12h.01"/></svg>
            </div>
            <p class="text-gray-500 text-lg">{{ __('site.sermons.no_live') }}</p>
        </div>
        @endif
    </div>
</section>

{{-- Gallery Section --}}
@php
    $galleryImages = \App\Models\GalleryItem::where('is_active', true)
        ->whereNotNull('image_path')
        ->orderBy('sort_order')
        ->take(8)
        ->get();
    $totalImages = \App\Models\GalleryItem::where('is_active', true)->whereNotNull('image_path')->count();
@endphp
@if($galleryImages->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="text-gold text-sm font-semibold uppercase tracking-wider">{{ app()->getLocale() === 'sw' ? 'Picha Zetu' : 'Gallery' }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">{{ app()->getLocale() === 'sw' ? 'Kumbukumbu za Ibada' : 'Moments from Ministry' }}</h2>
        </div>

        {{-- Masonry Grid --}}
        <div class="columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
            @foreach($galleryImages->take(7) as $item)
            <div class="break-inside-avoid group relative" data-aos="fade-up" data-aos-delay="{{ $loop->index % 4 * 50 }}">
                <a href="{{ asset('storage/' . $item->image_path) }}"
                   class="glightbox block rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300"
                   data-gallery="sermons-gallery"
                   data-title="{{ $item->title }}"
                   data-description="{{ $item->description }} <a href='{{ route('download.image', $item->id) }}' onclick='event.preventDefault();var f=document.createElement(&quot;iframe&quot;);f.style.display=&quot;none&quot;;f.src=this.href;document.body.appendChild(f);setTimeout(function(){document.body.removeChild(f)},5000);' style='display:inline-flex;align-items:center;gap:6px;margin-top:8px;padding:8px 16px;background:rgba(217,119,6,0.9);color:#fff;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;float:right;cursor:pointer;'>⬇ Download</a>">
                    <img src="{{ asset('storage/' . $item->image_path) }}"
                         alt="{{ $item->title }}"
                         class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500"
                         loading="lazy">
                    {{-- Overlay on hover --}}
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 rounded-xl flex items-center justify-center">
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center gap-2">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                        </div>
                    </div>
                </a>
                {{-- Download button --}}
                <a href="{{ route('download.image', $item->id) }}"
                   class="absolute bottom-3 right-3 w-8 h-8 bg-white/90 rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 hover:bg-gold hover:text-white"
                   title="Download">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                </a>
            </div>
            @endforeach

            {{-- +More overlay on last visible image --}}
            @if($totalImages > 7 && $galleryImages->count() > 7)
            <div class="break-inside-avoid group relative" data-aos="fade-up">
                <a href="{{ asset('storage/' . $galleryImages[7]->image_path) }}"
                   class="glightbox block rounded-xl overflow-hidden shadow-md"
                   data-gallery="sermons-gallery"
                   data-title="{{ $galleryImages[7]->title }}">
                    <img src="{{ asset('storage/' . $galleryImages[7]->image_path) }}"
                         alt="{{ $galleryImages[7]->title }}"
                         class="w-full h-auto object-cover"
                         loading="lazy">
                    <div class="absolute inset-0 bg-black/60 rounded-xl flex items-center justify-center">
                        <span class="text-white text-3xl font-bold">+{{ $totalImages - 7 }}</span>
                    </div>
                </a>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-16 bg-gradient-to-r from-primary-dark to-primary text-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-2xl md:text-3xl font-bold mb-4">{{ app()->getLocale() === 'sw' ? 'Usikose Mahubiri Yoyote' : 'Never Miss a Sermon' }}</h2>
        <p class="text-white/70 mb-8">{{ app()->getLocale() === 'sw' ? 'Jiandikishe kwenye YouTube channel yetu kupata mahubiri mapya kila wiki.' : 'Subscribe to our YouTube channel to get new sermons every week.' }}</p>
        <a href="https://www.youtube.com/@ApostleMathayonnko?sub_confirmation=1" target="_blank" rel="noopener"
           class="inline-flex items-center gap-3 px-8 py-4 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition shadow-lg">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            {{ app()->getLocale() === 'sw' ? 'Jiandikishe YouTube' : 'Subscribe on YouTube' }}
        </a>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-btn');
    const panels = document.querySelectorAll('.tab-panel');

    if (window.location.hash === '#live') {
        activateTab('live');
    }

    tabs.forEach(btn => {
        btn.addEventListener('click', () => {
            activateTab(btn.dataset.tab);
        });
    });

    function activateTab(tabName) {
        tabs.forEach(t => {
            t.classList.remove('active', 'border-primary', 'text-primary');
            t.classList.add('border-transparent', 'text-gray-500');
            t.setAttribute('aria-selected', 'false');
        });
        panels.forEach(p => p.classList.add('hidden'));

        const activeBtn = document.querySelector(`[data-tab="${tabName}"]`);
        const activePanel = document.getElementById(`panel-${tabName}`);

        if (activeBtn && activePanel) {
            activeBtn.classList.add('active', 'border-primary', 'text-primary');
            activeBtn.classList.remove('border-transparent', 'text-gray-500');
            activeBtn.setAttribute('aria-selected', 'true');
            activePanel.classList.remove('hidden');
        }
    }
});
</script>
@endpush
