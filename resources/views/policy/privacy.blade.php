@extends('layouts.app')

@section('title', 'Privacy Policy')

@php
$page = 'faq';
@endphp

@section('content')
<header class="page">
    <div class="container">
        <div class="page_header">
            <h1 class="page_header-title" data-aos="fade-up">{{ __('Privacy Policy') }}</h1>
            <p class="page_header-text" data-aos="fade-up" data-aos-delay="50">
                {{ __('We value your privacy and are committed to protecting your personal data in accordance with applicable laws.') }}
            </p>
        </div>
    </div>
</header>

<section class="rules section">
    <div class="container">
        <div class="rules_header text-center mb-4">
            <p class="rules_header-text" data-aos="fade-up" data-aos-delay="50">
                {{ __('This Privacy Policy explains how we collect, use, store, and protect your information when you use our Student Housing Rental Platform. By accessing or using our services, you agree to the practices described in this policy.') }}
            </p>
        </div>
        <div class="rules_main">
            <div class="rules_main-grid">
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('1. Information We Collect') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('Personal identification information (such as name, email address, phone number, and payment details).') }}</li>
                        <li>{{ __('Booking and housing details (check-in/check-out dates, room type, and preferences).') }}</li>
                        <li>{{ __('Technical information (IP address, device type, and browser information).') }}</li>
                        <li>{{ __('Communication records when you contact our support team.') }}</li>
                    </ul>
                </div>
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('2. How We Use Your Information') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('To provide, manage, and improve our housing rental services.') }}</li>
                        <li>{{ __('To process payments and issue invoices or receipts.') }}</li>
                        <li>{{ __('To ensure compliance with contracts, rules, and applicable laws.') }}</li>
                        <li>{{ __('To send important updates, notifications, or promotional offers.') }}</li>
                    </ul>
                </div>
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('3. Data Protection & Security') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('We implement strict technical and organizational measures to protect your data against unauthorized access, loss, misuse, or disclosure.') }}</li>
                        <li>{{ __('Your personal information is only accessible to authorized staff and partners under confidentiality obligations.') }}</li>
                        <li>{{ __('We do not sell, rent, or trade your personal data to third parties without your consent, except as required by law.') }}</li>
                    </ul>
                </div>
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('4. Your Rights') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('You have the right to access, update, or delete your personal data by contacting us.') }}</li>
                        <li>{{ __('You may withdraw your consent for data processing at any time, subject to legal or contractual restrictions.') }}</li>
                        <li>{{ __('You may request a copy of the information we hold about you.') }}</li>
                    </ul>
                </div>
                <div class="rules_main-grid_item mb-4" data-aos="fade-up">
                    <h5 class="rules_main-grid_item-title mb-2">{{ __('5. Changes to this Privacy Policy') }}</h5>
                    <ul class="rules_main-grid_item-list">
                        <li>{{ __('We may update this Privacy Policy from time to time. Any significant changes will be communicated via our platform or email notifications.') }}</li>
                        <li>{{ __('Your continued use of our services after changes indicates your acceptance of the updated policy.') }}</li>
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