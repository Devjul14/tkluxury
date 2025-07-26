@extends('layouts.app')

@section('title', 'Booking Confirmation')

@php
    $page = 'confirmation';
@endphp

@section('content')
    <header class="page">
        <div class="container">
            <div class="page_header text-center">
                <div class="page_header-icon" data-aos="fade-up">
                    <i class="icon-check-circle"></i>
                </div>
                <h1 class="page_header-title" data-aos="fade-up">Booking Confirmed!</h1>
                <p class="page_header-text" data-aos="fade-up" data-aos-delay="50">
                    Thank you for your booking. We've sent a confirmation email to your address.
                </p>
            </div>
        </div>
    </header>

    <section class="confirmation section">
        <div class="container">
            <div class="confirmation_main">
                <div class="confirmation_main-content">
                    <div class="confirmation_main-content_summary" data-aos="fade-up">
                        <h3 class="confirmation_main-content_summary-title">Booking Summary</h3>
                        
                        <div class="confirmation_main-content_summary_booking">
                            <div class="confirmation_main-content_summary_booking_header">
                                <h4 class="confirmation_main-content_summary_booking_header-title">Booking #{{ $booking->booking_number }}</h4>
                                <span class="confirmation_main-content_summary_booking_header_status status-success">Confirmed</span>
                            </div>
                            
                            <div class="confirmation_main-content_summary_booking_room">
                                <div class="confirmation_main-content_summary_booking_room-media">
                                    <img class="confirmation_main-content_summary_booking_room-media_img" src="{{ asset($booking->room->image) }}" alt="{{ $booking->room->name }}" />
                                </div>
                                <div class="confirmation_main-content_summary_booking_room-content">
                                    <h5 class="confirmation_main-content_summary_booking_room-content_title">{{ $booking->room->name }}</h5>
                                    <p class="confirmation_main-content_summary_booking_room-content_text">{{ $booking->room->type }}</p>
                                </div>
                            </div>

                            <div class="confirmation_main-content_summary_booking_details">
                                <div class="confirmation_main-content_summary_booking_details_item">
                                    <span class="label">Check-in:</span>
                                    <span class="value">{{ $booking->check_in->format('l, M d, Y') }}</span>
                                </div>
                                <div class="confirmation_main-content_summary_booking_details_item">
                                    <span class="label">Check-out:</span>
                                    <span class="value">{{ $booking->check_out->format('l, M d, Y') }}</span>
                                </div>
                                <div class="confirmation_main-content_summary_booking_details_item">
                                    <span class="label">Guests:</span>
                                    <span class="value">{{ $booking->guests }} {{ Str::plural('person', $booking->guests) }}</span>
                                </div>
                                <div class="confirmation_main-content_summary_booking_details_item">
                                    <span class="label">Nights:</span>
                                    <span class="value">{{ $booking->nights }}</span>
                                </div>
                            </div>

                            <div class="confirmation_main-content_summary_booking_pricing">
                                <div class="confirmation_main-content_summary_booking_pricing_item">
                                    <span class="label">Price per night:</span>
                                    <span class="value">${{ $booking->room->price }}</span>
                                </div>
                                <div class="confirmation_main-content_summary_booking_pricing_item">
                                    <span class="label">Subtotal:</span>
                                    <span class="value">${{ $booking->subtotal }}</span>
                                </div>
                                @if($booking->tax > 0)
                                <div class="confirmation_main-content_summary_booking_pricing_item">
                                    <span class="label">Tax:</span>
                                    <span class="value">${{ $booking->tax }}</span>
                                </div>
                                @endif
                                @if($booking->service_fee > 0)
                                <div class="confirmation_main-content_summary_booking_pricing_item">
                                    <span class="label">Service Fee:</span>
                                    <span class="value">${{ $booking->service_fee }}</span>
                                </div>
                                @endif
                                <div class="confirmation_main-content_summary_booking_pricing_item confirmation_main-content_summary_booking_pricing_item--total">
                                    <span class="label">Total Paid:</span>
                                    <span class="value">${{ $booking->total }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="confirmation_main-content_guest" data-aos="fade-up">
                        <h3 class="confirmation_main-content_guest-title">Guest Information</h3>
                        <div class="confirmation_main-content_guest_details">
                            <div class="confirmation_main-content_guest_details_item">
                                <span class="label">Name:</span>
                                <span class="value">{{ $booking->first_name }} {{ $booking->last_name }}</span>
                            </div>
                            <div class="confirmation_main-content_guest_details_item">
                                <span class="label">Email:</span>
                                <span class="value">{{ $booking->email }}</span>
                            </div>
                            <div class="confirmation_main-content_guest_details_item">
                                <span class="label">Phone:</span>
                                <span class="value">{{ $booking->phone }}</span>
                            </div>
                            @if($booking->address)
                            <div class="confirmation_main-content_guest_details_item">
                                <span class="label">Address:</span>
                                <span class="value">{{ $booking->address }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    @if($booking->special_requests)
                    <div class="confirmation_main-content_requests" data-aos="fade-up">
                        <h3 class="confirmation_main-content_requests-title">Special Requests</h3>
                        <p class="confirmation_main-content_requests-text">{{ $booking->special_requests }}</p>
                    </div>
                    @endif

                    <div class="confirmation_main-content_actions" data-aos="fade-up">
                        <div class="confirmation_main-content_actions_buttons">
                            <a class="btn btn--primary" href="{{ route('home') }}">
                                <i class="icon-home icon"></i>
                                <span>Back to Home</span>
                            </a>
                            <a class="btn btn--secondary" href="{{ route('booking.download', $booking->id) }}" target="_blank">
                                <i class="icon-download icon"></i>
                                <span>Download Receipt</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="confirmation_main-sidebar">
                    <div class="confirmation_main-sidebar_info" data-aos="fade-left">
                        <h3 class="confirmation_main-sidebar_info-title">What's Next?</h3>
                        <ul class="confirmation_main-sidebar_info_list">
                            <li class="confirmation_main-sidebar_info_list-item">
                                <i class="icon-email icon"></i>
                                <div class="content">
                                    <h4>Confirmation Email</h4>
                                    <p>We've sent a detailed confirmation email to {{ $booking->email }}</p>
                                </div>
                            </li>
                            <li class="confirmation_main-sidebar_info_list-item">
                                <i class="icon-clock icon"></i>
                                <div class="content">
                                    <h4>Check-in Time</h4>
                                    <p>Check-in is available from 2:00 PM on your arrival date</p>
                                </div>
                            </li>
                            <li class="confirmation_main-sidebar_info_list-item">
                                <i class="icon-location icon"></i>
                                <div class="content">
                                    <h4>Location</h4>
                                    <p>{{ config('contact.address.line1') }}, {{ config('contact.address.line2') }}</p>
                                </div>
                            </li>
                            <li class="confirmation_main-sidebar_info_list-item">
                                <i class="icon-call icon"></i>
                                <div class="content">
                                    <h4>Need Help?</h4>
                                    <p>Contact us at {{ config('contact.phone.primary') }} for any questions</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="confirmation_main-sidebar_contact" data-aos="fade-left" data-aos-delay="100">
                        <h3 class="confirmation_main-sidebar_contact-title">Contact Information</h3>
                        <div class="confirmation_main-sidebar_contact_details">
                            <div class="confirmation_main-sidebar_contact_details_item">
                                <i class="icon-call icon"></i>
                                <div class="content">
                                    <h4>Phone</h4>
                                    <a href="tel:{{ config('contact.phone.primary') }}">{{ config('contact.phone.primary') }}</a>
                                </div>
                            </div>
                            <div class="confirmation_main-sidebar_contact_details_item">
                                <i class="icon-email icon"></i>
                                <div class="content">
                                    <h4>Email</h4>
                                    <a href="mailto:{{ config('contact.email.primary') }}">{{ config('contact.email.primary') }}</a>
                                </div>
                            </div>
                            <div class="confirmation_main-sidebar_contact_details_item">
                                <i class="icon-location icon"></i>
                                <div class="content">
                                    <h4>Address</h4>
                                    <p>{{ config('contact.address.line1') }}<br>{{ config('contact.address.line2') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Auto-print functionality (optional)
        // window.onload = function() {
        //     window.print();
        // }
    </script>
@endpush 