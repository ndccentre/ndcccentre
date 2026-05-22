@extends('layouts.app')
@section('title', 'Blog & News')

@section('content')
<section class="relative py-40 bg-dark overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/90 via-dark/80 to-dark"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-2 bg-gold/20 text-gold text-sm font-semibold rounded-full mb-6" data-aos="fade-up">{{ app()->getLocale() === 'sw' ? 'Habari & Mafundisho' : 'News & Insights' }}</span>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6" data-aos="fade-up" data-aos-delay="100">{{ app()->getLocale() === 'sw' ? 'Blogu' : 'Blog' }}</h1>
        <p class="text-xl text-white/70 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">{{ app()->getLocale() === 'sw' ? 'Soma habari, ushuhuda, na mafundisho kutoka NDPCC.' : 'Read news, testimonies, and teachings from NDPCC.' }}</p>
    </div>
</section>

{{-- Categories --}}
<section class="py-6 bg-white border-b sticky top-[52px] md:top-[88px] z-30">
    <div class="max-w-7xl mx-auto px-4 flex flex-wrap gap-2">
        @php $loc = request()->route('locale') ?? app()->getLocale(); @endphp
        <a href="{{ route('blog', $loc) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ !request('category') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition">{{ $loc === 'sw' ? 'Zote' : 'All' }}</a>
        <a href="{{ route('blog', ['locale' => $loc, 'category' => 'news']) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('category') === 'news' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition">{{ $loc === 'sw' ? 'Habari za Kanisa' : 'Church News' }}</a>
        <a href="{{ route('blog', ['locale' => $loc, 'category' => 'testimony']) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('category') === 'testimony' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition">{{ $loc === 'sw' ? 'Ushuhuda' : 'Testimonies' }}</a>
        <a href="{{ route('blog', ['locale' => $loc, 'category' => 'sermon-discussion']) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('category') === 'sermon-discussion' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition">{{ $loc === 'sw' ? 'Mjadala wa Mahubiri' : 'Sermon Discussion' }}</a>
        <a href="{{ route('blog', ['locale' => $loc, 'category' => 'foundation']) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('category') === 'foundation' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition">Foundation</a>
    </div>
</section>

<section class="py-16 bg-gray-soft">
    <div class="max-w-7xl mx-auto px-4">
        @if($posts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <article class="bg-white rounded-2xl shadow-md overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index % 6 * 50 }}">
                @if($post->featured_image)
                <a href="{{ route('blog.show', ['locale' => $locale ?? 'en', 'slug' => $post->slug]) }}">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ app()->getLocale() === 'sw' && $post->title_sw ? $post->title_sw : $post->title }}" class="w-full h-52 object-cover">
                </a>
                @else
                <div class="w-full h-52 bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                    <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="px-2.5 py-0.5 bg-gold/10 text-gold text-xs font-bold rounded-full uppercase">{{ str_replace('-', ' ', $post->category) }}</span>
                        <span class="text-xs text-gray-400">{{ $post->published_at?->format('M d, Y') }}</span>
                    </div>
                    <a href="{{ route('blog.show', ['locale' => $locale ?? 'en', 'slug' => $post->slug]) }}">
                        <h2 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 hover:text-primary transition">{{ app()->getLocale() === 'sw' && $post->title_sw ? $post->title_sw : $post->title }}</h2>
                    </a>
                    @php $excerpt = app()->getLocale() === 'sw' && $post->excerpt_sw ? $post->excerpt_sw : ($post->excerpt ?: Str::limit(strip_tags($post->body), 120)); @endphp
                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ $excerpt }}</p>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('blog.show', ['locale' => $locale ?? 'en', 'slug' => $post->slug]) }}" class="text-primary font-semibold text-sm hover:gap-2 inline-flex items-center gap-1 transition-all">
                            {{ app()->getLocale() === 'sw' ? 'Soma Zaidi' : 'Read More' }} <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <span class="text-xs text-gray-400">{{ $post->views }} {{ app()->getLocale() === 'sw' ? 'maoni' : 'views' }}</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        <div class="mt-12">{{ $posts->links() }}</div>
        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
            <p class="text-gray-500 text-lg">{{ app()->getLocale() === 'sw' ? 'Hakuna machapisho bado. Rudi hivi karibuni!' : 'No posts yet. Check back soon!' }}</p>
        </div>
        @endif
    </div>
</section>
@endsection
