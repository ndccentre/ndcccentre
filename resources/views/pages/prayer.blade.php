@extends('layouts.app')
@section('title', __('site.prayer.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-32 bg-dark">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/80 to-dark"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">{{ __('site.prayer.title') }}</h1>
        <p class="text-lg text-white/70" data-aos="fade-up" data-aos-delay="100">{{ __('site.prayer.subtitle') }}</p>
    </div>
</section>

{{-- Prayer Form --}}
<section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-2xl mx-auto px-4">
        @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800 text-center">
            {{ __('site.prayer.success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('prayer.store', request()->route('locale') ?? 'sw') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('site.prayer.form_name') }}</label>
                <input type="text" name="name" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('site.prayer.form_email') }}</label>
                <input type="email" name="email"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('site.prayer.form_request') }}</label>
                <textarea name="request" rows="5" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                @error('request') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_public" value="1" id="is_public" class="rounded border-gray-300 text-primary focus:ring-primary">
                <label for="is_public" class="text-sm text-gray-700">{{ __('site.prayer.form_public') }}</label>
            </div>
            <button type="submit" class="w-full px-6 py-4 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition">
                {{ __('site.prayer.form_submit') }}
            </button>
        </form>
    </div>
</section>

{{-- Prayer Wall --}}
@if($publicRequests->count())
<section class="py-16 bg-gray-soft" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-primary text-center mb-8">{{ __('site.prayer.wall_title') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($publicRequests as $pr)
            <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-gold">
                <p class="text-gray-700 italic">"{{ $pr->request }}"</p>
                <p class="mt-3 text-sm text-gray-500 font-medium">— {{ $pr->name }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
