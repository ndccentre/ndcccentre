@extends('layouts.app')
@section('title', __('site.give.title'))

@section('content')
{{-- Hero --}}
<section class="relative py-32 bg-dark">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/80 to-dark"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">{{ __('site.give.title') }}</h1>
        <p class="text-lg text-white/70" data-aos="fade-up" data-aos-delay="100">{{ __('site.give.subtitle') }}</p>
    </div>
</section>

{{-- Giving Options --}}
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-12">

        {{-- M-Pesa --}}
        @if($showMpesa)
        <div class="bg-gray-soft rounded-xl p-8 border-t-4 border-gold" data-aos="fade-up">
            <h3 class="text-2xl font-bold text-primary mb-6">{{ __('site.give.mpesa_title') }}</h3>
            <div class="space-y-4">
                @if($mpesaNumber)
                <div>
                    <span class="text-sm text-gray-500 block">{{ __('site.give.mpesa_number') }}</span>
                    <span class="text-lg font-bold text-gray-900">{{ $mpesaNumber }}</span>
                </div>
                @endif
                <div>
                    <span class="text-sm text-gray-500 block">{{ __('site.give.mpesa_name') }}</span>
                    <span class="text-lg font-bold text-gray-900">NDPCC</span>
                </div>
                <div>
                    <span class="text-sm text-gray-500 block">{{ __('site.give.mpesa_ref') }}</span>
                    <div class="flex flex-wrap gap-2 mt-1">
                        @foreach(__('site.give.categories') as $key => $label)
                        <span class="px-3 py-1 bg-primary/10 text-primary text-sm font-medium rounded-full">{{ strtoupper($key) }} — {{ $label }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Bank --}}
        @if($showBank)
        <div class="bg-gray-soft rounded-xl p-8 border-t-4 border-primary" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-2xl font-bold text-primary mb-6">{{ __('site.give.bank_title') }}</h3>
            <div class="space-y-4">
                @if($bankName)
                <div>
                    <span class="text-sm text-gray-500 block">{{ __('site.give.bank_name') }}</span>
                    <span class="text-lg font-bold text-gray-900">{{ $bankName }}</span>
                </div>
                @endif
                @if($accountName)
                <div>
                    <span class="text-sm text-gray-500 block">{{ __('site.give.account_name') }}</span>
                    <span class="text-lg font-bold text-gray-900">{{ $accountName }}</span>
                </div>
                @endif
                @if($accountNumber)
                <div>
                    <span class="text-sm text-gray-500 block">{{ __('site.give.account_number') }}</span>
                    <span class="text-lg font-bold text-gray-900">{{ $accountNumber }}</span>
                </div>
                @endif
            </div>
        </div>
        @endif

    </div>
</section>
@endsection
