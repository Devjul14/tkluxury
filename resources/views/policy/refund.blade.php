@extends('layouts.app')

@section('title', 'Refund Policy')

@php
$page = 'faq';
@endphp

@section('content')
<header class="page">
    <div class="container">
        <div class="page_header">
            <h1 class="page_header-title" data-aos="fade-up">{{ __('Refund Policy') }}</h1>
            <p class="page_header-text" data-aos="fade-up" data-aos-delay="50">
                {{ __('This Refund Policy explains the conditions under which refunds may be issued for bookings made through our student housing rental platform.') }}
            </p>
        </div>
    </div>
</header>

<section class="rules section">
    <div class="container">
        <div class="rules_header text-center mb-4">
            <p class="rules_header-text" data-aos="fade-up" data-aos-delay="50">
                {{ __('By making a booking, you agree to this Refund Policy. We encourage you to review these terms before completing your reservation.') }}
            </p>
        </div>
        <div class="rules_main">
            <div class="rules_main-grid">
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('1. Eligibility for Refunds') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('Refund requests must be submitted within the timeframe specified at the time of booking.') }}</li>
                        <li>{{ __('Only cancellations made in accordance with the stated cancellation policy are eligible for refunds.') }}</li>
                        <li>{{ __('No-shows or late cancellations may not qualify for a refund.') }}</li>
                    </ul>
                </div>
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('2. Non-Refundable Fees') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('Certain fees, including administrative charges or processing fees, are non-refundable.') }}</li>
                        <li>{{ __('Special promotional bookings may also be non-refundable unless otherwise stated.') }}</li>
                    </ul>
                </div>
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('3. Refund Processing') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('Approved refunds will be processed within 7–14 business days.') }}</li>
                        <li>{{ __('Refunds will be issued to the original payment method used at the time of booking.') }}</li>
                        <li>{{ __('We are not responsible for delays caused by your bank or payment provider.') }}</li>
                    </ul>
                </div>
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('4. Force Majeure') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('In cases of natural disasters, pandemics, or government restrictions, refunds may be adjusted according to applicable laws and our discretion.') }}</li>
                        <li>{{ __('We may provide credit vouchers instead of cash refunds in such circumstances.') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('scripts')
<script src="{{ asset('asset/js/common.min.js') }}"></script>
@endpush