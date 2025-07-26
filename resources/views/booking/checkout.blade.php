@extends('layouts.app')

@section('title', 'Checkout')

@php
    $page = 'checkout';
@endphp

@section('content')
    <header class="page">
        <div class="container">
            <div class="page_header">
                <h1 class="page_header-title" data-aos="fade-up">Complete Your Booking</h1>
                <p class="page_header-text" data-aos="fade-up" data-aos-delay="50">
                    Please review your booking details and provide your information
                </p>
            </div>
        </div>
    </header>

    <section class="checkout section">
        <div class="container">
            <div class="checkout_main d-lg-flex">
                <div class="checkout_main-content">
                    <form class="checkout_main-content_form" action="{{ route('booking.process') }}" method="POST" id="checkout-form">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id ?? '' }}">
                        
                        <!-- Guest Information -->
                        <div class="checkout_main-content_form-section" data-aos="fade-up">
                            <h3 class="checkout_main-content_form-section_title">Guest Information</h3>
                            <div class="checkout_main-content_form-section_content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-group_label" for="first_name">First Name *</label>
                                            <input
                                                class="form-group_field field required"
                                                type="text"
                                                id="first_name"
                                                name="first_name"
                                                value="{{ old('first_name', $booking->first_name ?? '') }}"
                                                required
                                            />
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
                                                value="{{ old('last_name', $booking->last_name ?? '') }}"
                                                required
                                            />
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
                                                value="{{ old('email', $booking->email ?? '') }}"
                                                required
                                            />
                                            @error('email')
                                                <span class="form-group_error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-group_label" for="phone">Phone Number *</label>
                                            <input
                                                class="form-group_field field required"
                                                type="tel"
                                                id="phone"
                                                name="phone"
                                                value="{{ old('phone', $booking->phone ?? '') }}"
                                                required
                                            />
                                            @error('phone')
                                                <span class="form-group_error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-group_label" for="address">Address</label>
                                    <textarea
                                        class="form-group_field field"
                                        id="address"
                                        name="address"
                                        rows="3"
                                    >{{ old('address', $booking->address ?? '') }}</textarea>
                                    @error('address')
                                        <span class="form-group_error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Special Requests -->
                        <div class="checkout_main-content_form-section" data-aos="fade-up">
                            <h3 class="checkout_main-content_form-section_title">Special Requests</h3>
                            <div class="checkout_main-content_form-section_content">
                                <div class="form-group">
                                    <label class="form-group_label" for="special_requests">Additional Requests (Optional)</label>
                                    <textarea
                                        class="form-group_field field"
                                        id="special_requests"
                                        name="special_requests"
                                        rows="4"
                                        placeholder="Any special requests or preferences..."
                                    >{{ old('special_requests', $booking->special_requests ?? '') }}</textarea>
                                    @error('special_requests')
                                        <span class="form-group_error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="checkout_main-content_form-section" data-aos="fade-up">
                            <h3 class="checkout_main-content_form-section_title">Payment Information</h3>
                            <div class="checkout_main-content_form-section_content">
                                <div class="form-group">
                                    <label class="form-group_label" for="card_number">Card Number *</label>
                                    <input
                                        class="form-group_field field required"
                                        type="text"
                                        id="card_number"
                                        name="card_number"
                                        placeholder="1234 5678 9012 3456"
                                        required
                                    />
                                    @error('card_number')
                                        <span class="form-group_error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-group_label" for="expiry_date">Expiry Date *</label>
                                            <input
                                                class="form-group_field field required"
                                                type="text"
                                                id="expiry_date"
                                                name="expiry_date"
                                                placeholder="MM/YY"
                                                required
                                            />
                                            @error('expiry_date')
                                                <span class="form-group_error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-group_label" for="cvv">CVV *</label>
                                            <input
                                                class="form-group_field field required"
                                                type="text"
                                                id="cvv"
                                                name="cvv"
                                                placeholder="123"
                                                required
                                            />
                                            @error('cvv')
                                                <span class="form-group_error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-group_label" for="card_holder">Cardholder Name *</label>
                                    <input
                                        class="form-group_field field required"
                                        type="text"
                                        id="card_holder"
                                        name="card_holder"
                                        value="{{ old('card_holder', $booking->first_name . ' ' . $booking->last_name ?? '') }}"
                                        required
                                    />
                                    @error('card_holder')
                                        <span class="form-group_error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="checkout_main-content_form-section" data-aos="fade-up">
                            <div class="checkout_main-content_form-section_content">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <input
                                            class="checkbox_input"
                                            type="checkbox"
                                            id="terms"
                                            name="terms"
                                            required
                                        />
                                        <label class="checkbox_label" for="terms">
                                            I agree to the <a href="{{ route('terms') }}" target="_blank">Terms and Conditions</a> and <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a> *
                                        </label>
                                    </div>
                                    @error('terms')
                                        <span class="form-group_error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="checkout_main-sidebar">
                    <div class="checkout_main-sidebar_summary" data-aos="fade-left">
                        <h3 class="checkout_main-sidebar_summary-title">Booking Summary</h3>
                        
                        <div class="checkout_main-sidebar_summary_room">
                            <div class="checkout_main-sidebar_summary_room-media">
                                <img class="checkout_main-sidebar_summary_room-media_img" src="{{ asset($room->image) }}" alt="{{ $room->name }}" />
                            </div>
                            <div class="checkout_main-sidebar_summary_room-content">
                                <h4 class="checkout_main-sidebar_summary_room-content_title">{{ $room->name }}</h4>
                                <p class="checkout_main-sidebar_summary_room-content_text">{{ $room->type }}</p>
                            </div>
                        </div>

                        <div class="checkout_main-sidebar_summary_details">
                            <div class="checkout_main-sidebar_summary_details_item">
                                <span class="label">Check-in:</span>
                                <span class="value">{{ $booking->check_in->format('M d, Y') }}</span>
                            </div>
                            <div class="checkout_main-sidebar_summary_details_item">
                                <span class="label">Check-out:</span>
                                <span class="value">{{ $booking->check_out->format('M d, Y') }}</span>
                            </div>
                            <div class="checkout_main-sidebar_summary_details_item">
                                <span class="label">Guests:</span>
                                <span class="value">{{ $booking->guests }} {{ Str::plural('person', $booking->guests) }}</span>
                            </div>
                            <div class="checkout_main-sidebar_summary_details_item">
                                <span class="label">Nights:</span>
                                <span class="value">{{ $booking->nights }}</span>
                            </div>
                        </div>

                        <div class="checkout_main-sidebar_summary_pricing">
                            <div class="checkout_main-sidebar_summary_pricing_item">
                                <span class="label">Price per night:</span>
                                <span class="value">${{ $room->price }}</span>
                            </div>
                            <div class="checkout_main-sidebar_summary_pricing_item">
                                <span class="label">Subtotal:</span>
                                <span class="value">${{ $booking->subtotal }}</span>
                            </div>
                            @if($booking->tax > 0)
                            <div class="checkout_main-sidebar_summary_pricing_item">
                                <span class="label">Tax:</span>
                                <span class="value">${{ $booking->tax }}</span>
                            </div>
                            @endif
                            @if($booking->service_fee > 0)
                            <div class="checkout_main-sidebar_summary_pricing_item">
                                <span class="label">Service Fee:</span>
                                <span class="value">${{ $booking->service_fee }}</span>
                            </div>
                            @endif
                            <div class="checkout_main-sidebar_summary_pricing_item checkout_main-sidebar_summary_pricing_item--total">
                                <span class="label">Total:</span>
                                <span class="value">${{ $booking->total }}</span>
                            </div>
                        </div>

                        <button class="checkout_main-sidebar_summary_submit" type="submit" form="checkout-form">
                            <span class="checkout_main-sidebar_summary_submit-text">Complete Booking</span>
                            <i class="icon-arrow_right icon"></i>
                        </button>

                        <div class="checkout_main-sidebar_summary_security">
                            <i class="icon-lock icon"></i>
                            <span>Your payment information is secure and encrypted</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('asset/js/common.min.js') }}"></script>
@endpush 