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

    .badge-pending {
        background-color: rgba(255, 152, 0, 0.15);
        color: var(--warning-color);
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

    .razorpay-payment-button {
        background-color: #3a5bef;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.85rem 1.5rem;
        color: #fff;
        border-radius: var(--radius-sm);
        font-weight: 500;
        font-size: 0.95rem;
        transition: var(--transition);
        cursor: pointer;
        text-decoration: none;
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
            <h1 class="page_header-title" data-aos="fade-up">Payment {{ $payment->payment_status }}</h1>
            <p class="page_header-text" data-aos="fade-up" data-aos-delay="50">
                Thank you for your payment.
            </p>
        </div>
    </div>
</header>

<section class="section">
    <div class="row mb-2">
        <div class="card col-md-8 shadow mx-auto" data-aos="fade-up">
            <h3 class="card-header section-title">Payment Summary</h3>

            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span class="booking-number">#{{ $payment->transaction_id }}</span>
                    <span
                        class="status-badge {{ $payment->payment_status === 'completed' ? 'status-success' : 'badge-pending' }}">
                        @if ($payment->payment_status === 'pending')
                        <i class="icon-clock"></i>
                        @elseif($payment->payment_status === 'completed')
                        <i class="icon-check"></i>
                        @endif
                        {{ $payment->payment_status }}
                    </span>
                </div>
            </div>

        </div>



    </div>

    <div class="row mb-2">
        <div class="card col-md-8 shadow mx-auto" data-aos="fade-up">
            <h3 class="section-title">Guest Information</h3>
            <div>
                <div class="detail-item">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value">{{ $payment->booking->student->name }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{ $payment->booking->student->email }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value">{{ $payment->booking->student->phone ?? "-" }}</span>
                </div>
                @if ($payment->booking->special_requests)
                <div class="detail-item">
                    <span class="detail-label">Special Requests:</span>
                    <span class="detail-value" style="text-align: end;">{{ $payment->booking->special_requests }}</span>
                </div>
                @endif
                @if ($payment->booking->student->address)
                <div class="detail-item">
                    <span class="detail-label">Address:</span>
                    <span class="detail-value" style="text-align: end;">{{ $payment->booking->student->address }}</span>
                </div>
                @endif
            </div>
        </div>

    </div>

    <div class="row my-4">
        <div class="col-8 mx-auto">
            <a class="btn btn-primary" href="{{ route('home') }}">
                <i class="icon-home"></i>
                Back to Home
            </a>
            <a class="btn btn-outline" href="{{ route('booking.download', $payment->booking->booking_reference) }}"
                target="_blank">
                <i class="icon-download"></i>
                Download Receipt
            </a>
        </div>
    </div>
</section>
@endsection