@extends('layouts.app')

@section('title', 'Terms and Condition')

@php
$page = 'faq';
@endphp

@section('content')
<header class="page">
    <div class="container">
        <div class="page_header">
            <h1 class="page_header-title" data-aos="fade-up">{{ __('Terms & Conditions') }}</h1>
            <p class="page_header-text" data-aos="fade-up" data-aos-delay="50">
                {{ __('Please read these Terms & Conditions carefully before using our services.') }}
            </p>
        </div>
    </div>
</header>

<section class="rules section">
    <div class="container">
        <div class="rules_header text-center mb-4">
            <p class="rules_header-text" data-aos="fade-up" data-aos-delay="50">
                {{ __('By accessing or using our student housing rental platform, you agree to comply with these Terms & Conditions. Failure to comply may result in suspension or termination of your account.') }}
            </p>
        </div>
        <div class="rules_main">
            <div class="rules_main-grid">
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('1. Use of Services') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('You must be at least 18 years old to use our platform or have parental consent if younger.') }}</li>
                        <li>{{ __('You agree to provide accurate, current, and complete information when registering or booking.') }}</li>
                        <li>{{ __('You may not misuse the platform, including fraudulent bookings or misrepresentation.') }}</li>
                        <li>{{ __('We reserve the right to refuse service to anyone at any time.') }}</li>
                    </ul>
                </div>
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('2. Booking and Payments') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('All bookings are subject to availability and confirmation.') }}</li>
                        <li>{{ __('Payments must be made in accordance with the pricing displayed at the time of booking.') }}</li>
                        <li>{{ __('Late or failed payments may lead to cancellation of the booking.') }}</li>
                        <li>{{ __('Refunds are subject to our Refund Policy.') }}</li>
                    </ul>
                </div>
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('3. Responsibilities of Users') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('Users must maintain the property in good condition during their stay.') }}</li>
                        <li>{{ __('Any damage caused will be the responsibility of the tenant and may result in additional charges.') }}</li>
                        <li>{{ __('Respect for other tenants, neighbors, and property staff is mandatory.') }}</li>
                        <li>{{ __('Illegal activities on the property are strictly prohibited.') }}</li>
                    </ul>
                </div>
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('4. Limitation of Liability') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('We are not liable for personal loss, theft, or injury occurring on the premises.') }}</li>
                        <li>{{ __('We do not guarantee uninterrupted or error-free service but will make efforts to resolve issues promptly.') }}</li>
                        <li>{{ __('Our liability is limited to the amount paid for the booking in question.') }}</li>
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