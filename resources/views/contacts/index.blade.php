@extends('layouts.app')

@section('title', 'Contact Us')

@php
$page = 'contacts';
@endphp

@section('content')
<header class="page">
    <div class="container">
        <div class="page_header">
            <h1 class="page_header-title" data-aos="fade-up">Contact Us</h1>
            <p class="page_header-text" data-aos="fade-up" data-aos-delay="50">
                Get in touch with us for any questions or assistance
            </p>
        </div>
    </div>
</header>

<section class="contacts section">
    <div class="container container--contacts d-xl-flex align-items-center">
        <div class="contacts_info">
            <div class="contacts_info-header">
                <h2 class="contacts_info-header_title" data-aos="fade-down">Get In Touch</h2>
                <p class="contacts_info-header_text" data-aos="fade-up">
                    We're here to help and answer any questions you might have. We look forward to hearing from you.
                </p>
            </div>
            <ul class="contacts_info-list col-xl-7 d-md-flex flex-wrap">
                <li class="contacts_info-list_item col-md-6 d-flex align-items-center" data-order="1" data-aos="fade-up">
                    <span class="theme-element theme-element--light media">
                        <span class="icon-call icon">
                            <svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M26.9609 19.75L21 17.1797C20.7812 17.125 20.5625 17.0703 20.3438 17.0703C19.7969 17.0703 19.3047 17.2891 19.0312 17.6719L16.625 20.625C12.7969 18.7656 9.73438 15.7031 7.875 11.875L10.8281 9.46875C11.2109 9.19531 11.4297 8.70312 11.4297 8.15625C11.4297 7.9375 11.375 7.71875 11.3203 7.5L8.75 1.53906C8.47656 0.9375 7.875 0.5 7.21875 0.5C7.05469 0.5 6.94531 0.554688 6.83594 0.554688L1.3125 1.86719C0.546875 2.03125 0 2.6875 0 3.50781C0 17.3438 11.2109 28.5 24.9922 28.5C25.8125 28.5 26.4688 27.9531 26.6875 27.1875L27.9453 21.6641C27.9453 21.5547 27.9453 21.4453 27.9453 21.2812C27.9453 20.625 27.5625 20.0234 26.9609 19.75ZM24.9375 26.75C12.1406 26.75 1.75 16.3594 1.75 3.5625L7.16406 2.30469L9.67969 8.15625L5.6875 11.4375C8.36719 17.0703 11.4297 20.1328 17.1172 22.8125L20.3438 18.8203L26.1953 21.3359L24.9375 26.75Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                    </span>
                    <div class="main d-flex flex-column">
                        <h4 class="main_title">Phone</h4>
                        <a class="link" href="tel:{{ config('contact.phone.primary', '+1234567890') }}">{{ config('contact.phone.primary', '(329) 580-7077') }}</a>
                        <a class="link" href="tel:{{ config('contact.phone.secondary', '+1234567890') }}">{{ config('contact.phone.secondary', '(650) 382-5020') }}</a>
                    </div>
                </li>
                <li class="contacts_info-list_item col-md-6 d-flex align-items-center" data-order="2" data-aos="fade-up">
                    <span class="theme-element theme-element--light media">
                        <i class="icon-email icon"></i>
                    </span>
                    <div class="main d-flex flex-column">
                        <h4 class="main_title">Email</h4>
                        <a class="link" href="mailto:{{ config('contact.email.primary', 'contact@example.com') }}">{{ config('contact.email.primary', 'contact@example.com') }}</a>
                        <a class="link" href="mailto:{{ config('contact.email.secondary', 'support@example.com') }}">{{ config('contact.email.secondary', 'support@example.com') }}</a>
                    </div>
                </li>
                <li class="contacts_info-list_item col-md-6 d-flex align-items-center" data-order="3" data-aos="fade-up">
                    <span class="theme-element theme-element--light media">
                        <i class="icon-location icon"></i>
                    </span>
                    <div class="main d-flex flex-column">
                        <h4 class="main_title">Location</h4>
                        <span>{{ config('contact.address.line1', '54826 Fadel Circles') }}</span>
                        <span>{{ config('contact.address.line2', 'Darrylstad, AZ 90995') }}</span>
                    </div>
                </li>
                <li class="contacts_info-list_item col-md-6 d-flex align-items-center" data-order="4" data-aos="fade-up">
                    <span class="theme-element theme-element--light media">
                        <i class="icon-clock icon"></i>
                    </span>
                    <div class="main d-flex flex-column">
                        <h4 class="main_title">Working Time</h4>
                        <span>{{ config('contact.hours.days', 'Everyday') }}</span>
                        <span>{{ config('contact.hours.time', '10 am — 20 pm') }}</span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="contacts_map">
            <div id="map"></div>
        </div>
    </div>
</section>

<section class="contact-form section">
    <div class="container">
        <div class="contact-form_main">
            <div class="contact-form_main-header text-center">
                <h2 class="contact-form_main-header_title" data-aos="fade-up">Send Us a Message</h2>
                <p class="contact-form_main-header_text" data-aos="fade-up" data-aos-delay="50">
                    Have a question or need assistance? Fill out the form below and we'll get back to you as soon as possible.
                </p>
            </div>
            <div class="contact-form_main-content">
                <form class="contact-form_main-content_form" action="{{ route('contacts.store') }}" method="POST" data-aos="fade-up">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-group_label" for="first_name">First Name *</label>
                                <input
                                    class="form-group_field field required"
                                    type="text"
                                    id="first_name"
                                    name="first_name"
                                    value="{{ old('first_name') }}"
                                    required />
                                @error('first_name')
                                <span class="form-group_error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-group_label" for="last_name">Last Name *</label>
                                <input
                                    class="form-group_field field required"
                                    type="text"
                                    id="last_name"
                                    name="last_name"
                                    value="{{ old('last_name') }}"
                                    required />
                                @error('last_name')
                                <span class="form-group_error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-group_label" for="email">Email Address *</label>
                                <input
                                    class="form-group_field field required"
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required />
                                @error('email')
                                <span class="form-group_error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-group_label" for="phone">Phone Number</label>
                                <input
                                    class="form-group_field field"
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone') }}" />
                                @error('phone')
                                <span class="form-group_error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-group_label" for="subject">Subject *</label>
                        <select class="form-group_field field required" id="subject" name="subject" required>
                            <option value="">Select a subject</option>
                            <option value="general" {{ old('subject') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                            <option value="booking" {{ old('subject') == 'booking' ? 'selected' : '' }}>Booking Question</option>
                            <option value="support" {{ old('subject') == 'support' ? 'selected' : '' }}>Technical Support</option>
                            <option value="feedback" {{ old('subject') == 'feedback' ? 'selected' : '' }}>Feedback</option>
                            <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('subject')
                        <span class="form-group_error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-group_label" for="message">Message *</label>
                        <textarea
                            class="form-group_field field required"
                            id="message"
                            name="message"
                            rows="6"
                            placeholder="Please describe your inquiry..."
                            required>{{ old('message') }}</textarea>
                        @error('message')
                        <span class="form-group_error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <input
                                class="checkbox_input"
                                type="checkbox"
                                id="privacy"
                                name="privacy"
                                required />
                            <label class="checkbox_label" for="privacy">
                                I agree to the <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a> and consent to being contacted regarding my inquiry *
                            </label>
                        </div>
                        @error('privacy')
                        <span class="form-group_error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="contact-form_main-content_form-submit">
                        <button class="btn btn--primary" type="submit">
                            <span class="btn_text">Send Message</span>
                            <i class="icon-arrow_right icon"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('asset/js/common.min.js') }}"></script>
@endpush