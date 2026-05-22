@extends('layouts.app')
@section('title', __('site.sermons.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-32 bg-dark">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/80 to-dark"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">{{ __('site.sermons.title') }}</h1>
    </div>
</section>

{{-- Tabs Navigation --}}
<section class="bg-white border-b sticky top-0 z-30">
    <div class="max-w-7xl mx-auto px-4">
        <nav class="flex gap-1" id="sermon-tabs" role="tablist">
            <button type="button" role="tab" aria-selected="true" aria-controls="panel-sermons"
                    class="tab-btn active px-6 py-4 text-sm font-semibold border-b-2 border-primary text-primary transition"
                    data-tab="sermons">
                {{ __('site.sermons.tab_sermons') }}
            </button>
            <button type="button" role="tab" aria-selected="false" aria-controls="panel-shorts"
                    class="tab-btn px-6 py-4 text-sm font-semibold border-b-2 border-transparent text-gray-500 hover:text-primary transition"
                    data-tab="shorts">
                {{ __('site.sermons.tab_shorts') }}
            </button>
            <button type="button" role="tab" aria-selected="false" aria-controls="panel-live"
                    class="tab-btn px-6 py-4 text-sm font-semibold border-b-2 border-transparent text-gray-500 hover:text-primary transition"
                    data-tab="live">
                @if($isLive)
                    <span class="inline-block w-2 h-2 bg-red-500 rounded-full animate-pulse mr-1"></span>
                @endif
                {{ __('site.sermons.tab_live') }}
            </button>
        </nav>
    </div>
</section>

{{-- Tab 1: Sermons --}}
<section id="panel-sermons" class="tab-panel py-16 bg-white" role="tabpanel">
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
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-delay="{{ $loop->index % 6 * 50 }}">
                <div class="relative h-48 bg-gray-200 overflow-hidden group">
                    @if($video->thumbnail)
                    <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-primary to-primary-dark"></div>
                    @endif
                    @if($video->embed_url)
                    <a href="{{ $video->embed_url }}" class="glightbox absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-primary ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </a>
                    @endif
                    @if($video->duration_str)
                    <span class="absolute bottom-2 right-2 bg-black/80 text-white text-xs px-2 py-0.5 rounded">{{ $video->duration_str }}</span>
                    @endif
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 mb-1 line-clamp-2">{{ $video->title }}</h3>
                    @if(!empty($video->speaker))
                    <p class="text-sm text-gray-500 mb-1">{{ $video->speaker }}</p>
                    @endif
                    <div class="flex items-center justify-between text-xs text-gray-400 mt-3">
                        @if($video->published_at)
                        <span>{{ \Carbon\Carbon::parse($video->published_at)->format('M d, Y') }}</span>
                        @endif
                        @if($video->view_count > 0)
                        <span>{{ number_format($video->view_count) }} {{ __('site.sermons.views') }}</span>
                        @endif
                    </div>
                    @if($video->watch_url)
                    <a href="{{ $video->watch_url }}" target="_blank" rel="noopener"
                       class="inline-block mt-3 text-sm text-primary font-medium hover:underline">
                        {{ __('site.sermons.watch_youtube') }} →
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-gray-500 text-lg py-12">{{ __('site.sermons.no_results') }}</p>
        @endif
    </div>
</section>

{{-- Tab 2: Shorts --}}
<section id="panel-shorts" class="tab-panel py-16 bg-white hidden" role="tabpanel">
    <div class="max-w-7xl mx-auto px-4">
        @if($shorts->count())
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($shorts as $video)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-delay="{{ $loop->index % 8 * 50 }}">
                <div class="relative aspect-[9/16] bg-gray-200 overflow-hidden group">
                    <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                    <a href="{{ $video['embed_url'] }}" class="glightbox absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-14 h-14 bg-white/90 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-red-500 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </a>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-sm text-gray-900 line-clamp-2">{{ $video['title'] }}</h3>
                    <p class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($video['published_at'])->format('M d, Y') }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-gray-500 text-lg py-12">{{ __('site.sermons.no_shorts') }}</p>
        @endif
    </div>
</section>

{{-- Tab 3: Live --}}
<section id="panel-live" class="tab-panel py-16 bg-white hidden" role="tabpanel">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Live Now Banner --}}
        @if($isLive && $liveVideoId)
        <div class="mb-12 bg-gradient-to-r from-red-600 to-red-700 rounded-2xl p-6 md:p-8 shadow-xl" data-aos="fade-up">
            <div class="flex items-center gap-3 mb-4">
                <span class="inline-flex items-center gap-2 bg-white/20 text-white text-sm font-bold px-4 py-1.5 rounded-full">
                    <span class="w-2.5 h-2.5 bg-white rounded-full animate-pulse"></span>
                    {{ __('site.sermons.live_badge') }}
                </span>
            </div>
            <div class="rounded-xl overflow-hidden">
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
        <h2 class="text-2xl font-bold text-gray-900 mb-8">{{ __('site.sermons.past_live') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($lives as $video)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:-translate-y-1 transition-transform" data-aos="fade-up">
                <div class="relative h-48 bg-gray-200 overflow-hidden group">
                    <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                    <a href="{{ $video['embed_url'] }}" class="glightbox absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-primary ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </a>
                    @if($video['duration_str'])
                    <span class="absolute bottom-2 right-2 bg-black/80 text-white text-xs px-2 py-0.5 rounded">{{ $video['duration_str'] }}</span>
                    @endif
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 mb-1 line-clamp-2">{{ $video['title'] }}</h3>
                    <div class="flex items-center justify-between text-xs text-gray-400 mt-3">
                        <span>{{ \Carbon\Carbon::parse($video['published_at'])->format('M d, Y') }}</span>
                        @if($video['view_count'] > 0)
                        <span>{{ number_format($video['view_count']) }} {{ __('site.sermons.views') }}</span>
                        @endif
                    </div>
                    <a href="{{ $video['watch_url'] }}" target="_blank" rel="noopener"
                       class="inline-block mt-3 text-sm text-primary font-medium hover:underline">
                        {{ __('site.sermons.watch_youtube') }} →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @elseif(!$isLive)
        <p class="text-center text-gray-500 text-lg py-12">{{ __('site.sermons.no_live') }}</p>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-btn');
    const panels = document.querySelectorAll('.tab-panel');

    // Check if URL has #live hash
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
