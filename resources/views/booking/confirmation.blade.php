@use('Carbon\Carbon')

@extends('layouts.app')

@section('title', 'Booking Confirmation')

@php
$page = 'confirmation';
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('asset/css/room.min.css') }}">
<style>
    :root {
        --primary-color: #4a6bff;
        --success-color: #28a745;
        --text-color: #333;
        --text-light: #666;
        --border-color: #e0e0e0;
        --bg-light: #f9fafb;
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.05);
        --radius-md: 8px;
        --radius-sm: 4px;
        --transition: all 0.2s ease;
    }

    /* Base Styles */
    .page_header {
        padding: 3rem 0;
        background-color: var(--bg-light);
        margin-bottom: 2rem;
    }

    .page_header-icon {
        font-size: 3.5rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .page_header-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--text-color);
        text-align: center;
        margin-bottom: 0.75rem;
    }

    .page_header-text {
        font-size: 1.1rem;
        color: var(--text-light);
        max-width: 600px;
        height: 12rem;
        margin: 0 auto;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Main Layout */
    .confirmation_main {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .confirmation_main-content {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .confirmation_main-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        position: sticky;
        top: 1rem;
        height: fit-content;
    }

    /* Section Headings */
    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 1rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--primary-color);
        border-radius: 3px;
    }

    /* Cards */
    .card {
        background: #fff;
        border-radius: var(--radius-md);
        padding: 1.75rem;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
    }

    .card:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.85rem;
    }

    .status-success {
        background-color: rgba(40, 167, 69, 0.15);
        color: var(--success-color);
    }

    /* Booking Header */
    .booking-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .booking-number {
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--text-color);
    }

    /* Room Info */
    .room-card {
        display: flex;
        gap: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .room-media {
        flex-shrink: 0;
        width: 120px;
        height: 90px;
        border-radius: var(--radius-sm);
        overflow: hidden;
    }

    .room-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .room-title {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
    }

    .room-type {
        font-size: 0.9rem;
        color: var(--text-light);
    }

    /* Detail Items */
    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 500;
        color: var(--text-light);
    }

    .detail-value {
        font-weight: 500;
        color: var(--text-color);
    }

    .detail-total {
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--text-color);
    }

    /* Info List */
    .info-list {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .info-item {
        display: flex;
        gap: 1rem;
    }

    .info-icon {
        color: var(--primary-color);
        font-size: 1.25rem;
        margin-top: 0.25rem;
        flex-shrink: 0;
    }

    .info-title {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }

    .info-text {
        color: var(--text-light);
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.85rem 1.5rem;
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 0.95rem;
        transition: var(--transition);
        cursor: pointer;
        text-decoration: none;
    }

    .btn-primary {
        background-color: var(--primary-color);
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #3a5bef;
        transform: translateY(-1px);
    }

    .btn-outline {
        background-color: transparent;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
    }

    .btn-outline:hover {
        background-color: rgba(74, 107, 255, 0.05);
    }

    /* Special Requests */
    .special-requests {
        background: #fff;
        padding: 1.25rem;
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        border-left: 3px solid var(--primary-color);
    }

    .special-requests p {
        color: var(--text-light);
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .confirmation_main {
            grid-template-columns: 1fr;
        }

        .confirmation_main-sidebar {
            position: static;
        }
    }

    @media (max-width: 576px) {
        .action-buttons {
            flex-direction: column;
        }

        .room-card {
            flex-direction: column;
        }

        .room-media {
            width: 100%;
            height: 180px;
        }
    }
</style>
@endpush

@section('content')
<header class="page_header">
    <div class="container">
        <div class="text-center">
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

<section class="section">
    <div class="container">
        <div class="confirmation_main">
            <div class="confirmation_main-content">
                <!-- Booking Summary -->
                <div class="card" data-aos="fade-up">
                    <h3 class="section-title">Booking Summary</h3>

                    <div class="booking-header">
                        <span class="booking-number">#{{ $booking->booking_reference }}</span>
                        <span class="status-badge status-success">
                            <i class="icon-check"></i>
                            Confirmed
                        </span>
                    </div>

                    <div class="room-card">
                        <div class="room-media">
                            <img src="{{ $booking->room->image ? asset($booking->room->image) : asset('img/hero.webp') }}" alt="{{ $booking->room->name }}" />
                        </div>
                        <div>
                            <h5 class="room-title">{{ $booking->room->name }}</h5>
                            <p class="room-type">{{ $booking->room->type }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="detail-item">
                            <span class="detail-label">Check-in:</span>
                            <span class="detail-value">{{ Carbon::parse($booking->check_in_date)->format('l, M d, Y') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Check-out:</span>
                            <span class="detail-value">{{ Carbon::parse($booking->check_out_date)->format('l, M d, Y') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Guests:</span>
                            <span class="detail-value">{{ $booking->room->capacity }} {{ Str::plural('person', $booking->room->capacity) }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Nights:</span>
                            <span class="detail-value">{{ Carbon::parse($booking->check_in_date)->diffInDays(Carbon::parse($booking->check_out_date)) }}</span>
                        </div>
                    </div>


                    <div>
                        <div class="detail-item">
                            <span class="detail-label">Price per night:</span>
                            <span class="detail-value">${{ number_format($booking->room->price, 2) }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Subtotal:</span>
                            <span class="detail-value">${{ number_format($booking->subtotal, 2) }}</span>
                        </div>
                        @if($booking->tax > 0)
                        <div class="detail-item">
                            <span class="detail-label">Tax:</span>
                            <span class="detail-value">${{ number_format($booking->tax, 2) }}</span>
                        </div>
                        @endif
                        @if($booking->service_fee > 0)
                        <div class="detail-item">
                            <span class="detail-label">Service Fee:</span>
                            <span class="detail-value">${{ number_format($booking->service_fee, 2) }}</span>
                        </div>
                        @endif
                        <div class="detail-item">
                            <span class="detail-label">Total:</span>
                            <span class="detail-value detail-total">${{ number_format($booking->total_amount, 2) }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Down Payment:</span>
                            <span class="detail-value detail-total">${{ number_format($booking->down_payment_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Guest Information -->
                <div class="card" data-aos="fade-up">
                    <h3 class="section-title">Guest Information</h3>
                    <div>
                        <div class="detail-item">
                            <span class="detail-label">Name:</span>
                            <span class="detail-value">{{ $booking->student->name }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Email:</span>
                            <span class="detail-value">{{ $booking->student->email }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Phone:</span>
                            <span class="detail-value">{{ $booking->student->phone }}</span>
                        </div>
                        @if($booking->special_requests)
                        <div class="detail-item">
                            <span class="detail-label">Special Requests:</span>
                            <span class="detail-value">{{ $booking->special_requests }}</span>
                        </div>
                        @endif
                        @if($booking->student->address)
                        <div class="detail-item">
                            <span class="detail-label">Address:</span>
                            <span class="detail-value">{{ $booking->student->address }}</span>
                        </div>
                        @endif
                    </div>
                </div>


                <!-- Services -->
                <div class="card" data-aos="fade-up">
                    <h3 class="section-title">Services</h3>
                    <div>
                        @foreach ($booking->services as $service)
                        <div class="detail-item">
                            <span class="detail-label">{{ $service->title }}</span>
                            <span class="detail-value">{{ $service->price }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Special Requests -->
                @if($booking->special_requests)
                <div class="special-requests" data-aos="fade-up">
                    <h3 class="section-title">Special Requests</h3>
                    <p>{{ $booking->special_requests }}</p>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="action-buttons" data-aos="fade-up">
                    <a class="btn btn-primary" href="{{ route('home') }}">
                        <i class="icon-home"></i>
                        Back to Home
                    </a>
                    <a class="btn btn-outline" href="{{ route('booking.download', $booking->booking_reference) }}" target="_blank">
                        <i class="icon-download"></i>
                        Download Receipt
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="confirmation_main-sidebar">
                <div class="card" data-aos="fade-left">
                    <h3 class="section-title">What's Next?</h3>
                    <div class="info-list">
                        <div class="info-item">
                            <i class="icon-email info-icon"></i>
                            <div>
                                <h4 class="info-title">Confirmation Email</h4>
                                <p class="info-text">We've sent a detailed confirmation email to {{ $booking->student->email }}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="icon-clock info-icon"></i>
                            <div>
                                <h4 class="info-title">Check-in Time</h4>
                                <p class="info-text">Check-in is available from 2:00 PM on your arrival date</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="icon-location info-icon"></i>
                            <div>
                                <h4 class="info-title">Location</h4>
                                <p class="info-text">{{ config('contact.address.line1') }}, {{ config('contact.address.line2') }}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="icon-call info-icon"></i>
                            <div>
                                <h4 class="info-title">Need Help?</h4>
                                <p class="info-text">Contact us at {{ config('contact.phone.primary') }} for any questions</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" data-aos="fade-left" data-aos-delay="100">
                    <h3 class="section-title">Contact Information</h3>
                    <div class="info-list">
                        <div class="info-item">
                            <i class="icon-phone info-icon"></i>
                            <div>
                                <h4 class="info-title">Phone</h4>
                                <a href="tel:{{ config('contact.phone.primary') }}" class="info-text">{{ config('contact.phone.primary') }}</a>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="icon-email info-icon"></i>
                            <div>
                                <h4 class="info-title">Email</h4>
                                <a href="mailto:{{ config('contact.email.primary') }}" class="info-text">{{ config('contact.email.primary') }}</a>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="icon-location info-icon"></i>
                            <div>
                                <h4 class="info-title">Address</h4>
                                <p class="info-text">{{ config('contact.address.line1') }}<br>{{ config('contact.address.line2') }}</p>
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
    // Optional: Add any interactive elements here
    document.addEventListener('DOMContentLoaded', function() {
        // Example: Print button functionality
        // const printButton = document.createElement('button');
        // printButton.className = 'btn btn-outline';
        // printButton.innerHTML = '<i class="icon-printer"></i> Print Confirmation';
        // printButton.addEventListener('click', () => window.print());
        // document.querySelector('.action-buttons').appendChild(printButton);
    });
</script>
@endpush