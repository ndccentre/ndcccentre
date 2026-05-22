@extends('layouts.app')
@section('title', $post->meta_title ?: $post->title)
@section('meta_description', $post->meta_description ?: Str::limit(strip_tags($post->body), 160))

@section('content')
<section class="relative py-32 bg-dark overflow-hidden">
    @if($post->featured_image)
    <img src="{{ asset('storage/' . $post->featured_image) }}" class="absolute inset-0 w-full h-full object-cover">
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/70 to-dark/40"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <span class="inline-block px-3 py-1 bg-gold/20 text-gold text-xs font-bold rounded-full uppercase mb-4">{{ str_replace('-', ' ', $post->category) }}</span>
        <h1 class="text-3xl md:text-5xl font-bold text-white mb-4 leading-tight">{{ app()->getLocale() === 'sw' && $post->title_sw ? $post->title_sw : $post->title }}</h1>
        <div class="flex items-center justify-center gap-4 text-white/60 text-sm">
            <span>{{ $post->published_at?->format('M d, Y') }}</span>
            <span>•</span>
            <span>{{ $post->views }} {{ app()->getLocale() === 'sw' ? 'maoni' : 'views' }}</span>
            <span>•</span>
            <span>{{ $post->approvedComments()->count() }} {{ app()->getLocale() === 'sw' ? 'maoni' : 'comments' }}</span>
        </div>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        {{-- Article Body --}}
        <article class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-p:text-gray-700 prose-a:text-primary prose-img:rounded-xl" data-aos="fade-up">
            {!! app()->getLocale() === 'sw' && $post->body_sw ? $post->body_sw : $post->body !!}
        </article>

        {{-- Share --}}
        <div class="mt-12 pt-8 border-t border-gray-200 flex items-center gap-4" data-aos="fade-up">
            <span class="text-sm font-semibold text-gray-700">{{ app()->getLocale() === 'sw' ? 'Shiriki:' : 'Share:' }}</span>
            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" class="w-9 h-9 rounded-full flex items-center justify-center" style="background:#25D366;"><svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center"><svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
        </div>

        {{-- Comments Section --}}
        <div class="mt-16" data-aos="fade-up">
            <h3 class="text-2xl font-bold text-gray-900 mb-8">{{ app()->getLocale() === 'sw' ? 'Maoni' : 'Comments' }} ({{ $comments->count() }})</h3>

            @if(session('comment_submitted'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-medium">
                ✓ {{ app()->getLocale() === 'sw' ? 'Maoni yako yamepokelewa na yataonekana baada ya kuidhinishwa.' : 'Your comment has been submitted and will appear after approval.' }}
            </div>
            @endif

            {{-- Existing Comments --}}
            @if($comments->count())
            <div class="space-y-6 mb-12">
                @foreach($comments as $comment)
                <div class="flex gap-4 p-5 bg-gray-soft rounded-xl">
                    <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center shrink-0">
                        <span class="text-primary font-bold text-sm">{{ strtoupper(substr($comment->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-semibold text-gray-900 text-sm">{{ $comment->name }}</span>
                            <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700 text-sm">{{ $comment->body }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Comment Form --}}
            <div class="bg-gray-soft rounded-2xl p-8">
                <h4 class="text-lg font-bold text-gray-900 mb-4">{{ app()->getLocale() === 'sw' ? 'Acha Maoni' : 'Leave a Comment' }}</h4>
                <form method="POST" action="{{ route('blog.comment', ['locale' => $locale ?? 'en', 'slug' => $post->slug]) }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <input type="text" name="name" required placeholder="{{ app()->getLocale() === 'sw' ? 'Jina lako *' : 'Your name *' }}" class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent">
                        <input type="email" name="email" placeholder="{{ app()->getLocale() === 'sw' ? 'Barua pepe (hiari)' : 'Email (optional)' }}" class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <textarea name="body" rows="4" required placeholder="{{ app()->getLocale() === 'sw' ? 'Andika maoni yako...' : 'Write your comment...' }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent resize-none"></textarea>
                    <button type="submit" class="px-6 py-3 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition">
                        {{ app()->getLocale() === 'sw' ? 'Tuma Maoni' : 'Submit Comment' }}
                    </button>
                </form>
            </div>
        </div>

        {{-- Related Posts --}}
        @if($related->count())
        <div class="mt-16" data-aos="fade-up">
            <h3 class="text-2xl font-bold text-gray-900 mb-8">{{ app()->getLocale() === 'sw' ? 'Soma Pia' : 'Related Posts' }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($related as $rel)
                <a href="{{ route('blog.show', ['locale' => $locale ?? 'en', 'slug' => $rel->slug]) }}" class="bg-gray-soft rounded-xl overflow-hidden hover:-translate-y-1 transition-all">
                    @if($rel->featured_image)
                    <img src="{{ asset('storage/' . $rel->featured_image) }}" class="w-full h-32 object-cover">
                    @endif
                    <div class="p-4">
                        <h4 class="font-bold text-gray-900 text-sm line-clamp-2">{{ app()->getLocale() === 'sw' && $rel->title_sw ? $rel->title_sw : $rel->title }}</h4>
                        <span class="text-xs text-gray-400 mt-1">{{ $rel->published_at?->format('M d, Y') }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
