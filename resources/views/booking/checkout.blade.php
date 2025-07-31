@use('Illuminate\Support\Number')
@extends('layouts.app')

@section('title', 'Checkout')

@php
    $page = 'checkout';
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('asset/css/room.min.css') }}">
    <style>
        /* --- Checkout Section --- */
.checkout.section {
    padding: 60px 0; /* Padding atas dan bawah untuk section */
    background-color: #f8f9fa; /* Warna latar belakang yang lembut, seperti body Bootstrap */
}

.checkout_main {
    gap: 30px; /* Jarak antara konten utama dan sidebar di layout d-lg-flex */
}

/* --- Checkout Main Content (Form) --- */
.checkout_main-content {
    flex: 1; /* Mengambil ruang yang tersedia */
    background-color: #fff;
    border: 1px solid #dee2e6; /* Border standar Bootstrap */
    border-radius: 0.375rem; /* Sudut membulat standar Bootstrap */
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); /* Sedikit bayangan */
    padding: 30px;
}

.checkout_main-content_form-section {
    margin-bottom: 40px; /* Jarak antar bagian form */
}

.checkout_main-content_form-section:last-child {
    margin-bottom: 0; /* Hapus margin bawah untuk section terakhir */
}

.checkout_main-content_form-section_title {
    font-size: 1.6rem; /* Ukuran judul section */
    color: #343a40; /* Warna teks gelap */
    margin-bottom: 25px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e9ecef; /* Garis bawah untuk judul */
    font-weight: 600; /* Sedikit tebal */
}

/* Form Group & Fields */
.form-group {
    margin-bottom: 20px; /* Jarak antar form group */
}

.form-group_label {
    display: block; /* Pastikan label di baris baru */
    font-weight: 500; /* Sedikit lebih tebal */
    color: #495057; /* Warna teks label */
    margin-bottom: 8px; /* Jarak antara label dan input */
}

.form-group_field {
    display: block;
    width: 100%;
    padding: 0.75rem 1rem; /* Padding seperti form-control Bootstrap */
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da; /* Border standar Bootstrap */
    border-radius: 0.375rem; /* Sudut membulat standar Bootstrap */
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

textarea.form-group_field {
    padding: 1rem;
}

.form-group_field:focus {
    color: #212529;
    background-color: #fff;
    border-color: #86b7fe; /* Warna focus Bootstrap */
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25); /* Shadow focus Bootstrap */
}

.form-group_field::placeholder {
    color: #6c757d; /* Warna placeholder */
    opacity: 1; /* Pastikan placeholder terlihat */
}

.form-group_error {
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545; /* Warna merah error Bootstrap */
}

/* Checkbox */
.checkbox {
    display: flex;
    align-items: flex-start; /* Align item di bagian atas */
    margin-bottom: 20px;
}

.checkbox_input {
    width: 1em;
    height: 1em;
    margin-top: 0.25em; /* Sesuaikan posisi vertikal */
    margin-right: 0.5em; /* Jarak antara checkbox dan label */
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.25);
    border-radius: 0.25em;
    appearance: none; /* Sembunyikan default checkbox */
    -webkit-print-color-adjust: exact;
    color-adjust: exact;
    print-color-adjust: exact;
    transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.checkbox_input:checked {
    background-color: #0d6efd; /* Warna primary Bootstrap */
    border-color: #0d6efd;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e"); /* Icon centang Bootstrap */
    background-size: 100% 100%;
    background-position: center;
    background-repeat: no-repeat;
}

.checkbox_input:focus {
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.checkbox_label {
    color: #212529;
    font-size: 1rem;
    cursor: pointer;
    line-height: 1.5;
}

.checkbox_label a {
    color: #0d6efd; /* Warna link primary Bootstrap */
    text-decoration: none;
}

.checkbox_label a:hover {
    color: #0a58ca; /* Warna link hover Bootstrap */
    text-decoration: underline;
}

/* --- Checkout Main Sidebar (Summary) --- */
.checkout_main-sidebar {
    width: 380px; /* Lebar fixed untuk sidebar, bisa disesuaikan */
    flex-shrink: 0; /* Mencegah sidebar mengecil */
}

@media (max-width: 991.98px) {
    .checkout_main-sidebar {
        width: 100%; /* Full width di bawah breakpoint lg */
        margin-top: 30px; /* Jarak atas jika layout menjadi stack */
    }
}

.checkout_main-sidebar_summary {
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    padding: 30px;
    position: sticky; /* Agar sidebar tetap saat scroll */
    top: 30px; /* Jarak dari atas viewport */
}

.checkout_main-sidebar_summary-title {
    font-size: 1.5rem;
    color: #343a40;
    margin-bottom: 25px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e9ecef;
    font-weight: 600;
    text-align: center; /* Judul di tengah */
}

/* Room Details in Summary */
.checkout_main-sidebar_summary_room {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e9ecef;
}

.checkout_main-sidebar_summary_room-media {
    flex-shrink: 0; /* Mencegah gambar mengecil */
    width: 100px; /* Lebar gambar */
    height: 80px; /* Tinggi gambar */
    overflow: hidden;
    border-radius: 0.25rem;
}

.checkout_main-sidebar_summary_room-media_img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Pastikan gambar mengisi area tanpa terdistorsi */
}

.checkout_main-sidebar_summary_room-content_title {
    font-size: 1.25rem;
    color: #343a40;
    margin-bottom: 5px;
    font-weight: 600;
}

.checkout_main-sidebar_summary_room-content_text {
    font-size: 0.95rem;
    color: #6c757d;
    margin-bottom: 0;
}

/* Booking Details */
.checkout_main-sidebar_summary_details {
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e9ecef;
}

.checkout_main-sidebar_summary_details_item {
    display: flex;
    justify-content: space-between; /* Label di kiri, value di kanan */
    margin-bottom: 10px;
    font-size: 1rem;
    color: #495057;
}

.checkout_main-sidebar_summary_details_item:last-child {
    margin-bottom: 0;
}

.checkout_main-sidebar_summary_details_item .label {
    font-weight: 500;
}

.checkout_main-sidebar_summary_details_item .value {
    font-weight: 400;
}

/* Pricing Summary */
.checkout_main-sidebar_summary_pricing {
    margin-bottom: 30px;
}

.checkout_main-sidebar_summary_pricing_item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    font-size: 1rem;
    color: #495057;
}

.checkout_main-sidebar_summary_pricing_item .label {
    font-weight: 500;
}

.checkout_main-sidebar_summary_pricing_item .value {
    font-weight: 500;
}

.checkout_main-sidebar_summary_pricing_item--total {
    border-top: 1px solid #e9ecef;
    padding-top: 15px;
    margin-top: 20px;
    font-size: 1.3rem;
    font-weight: 700;
    color: #212529; /* Warna teks lebih gelap untuk total */
}

.checkout_main-sidebar_summary_pricing_item--total .value {
    color: #0d6efd; /* Warna primary untuk total harga */
    font-size: 1.4rem;
}

/* Submit Button */
.checkout_main-sidebar_summary_submit {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 12px 20px;
    font-size: 1.15rem;
    font-weight: 600;
    color: #fff;
    background-color: #0d6efd; /* Warna primary Bootstrap */
    border: 1px solid #0d6efd;
    border-radius: 0.375rem;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.checkout_main-sidebar_summary_submit:hover {
    background-color: #0b5ed7; /* Warna primary darker pada hover */
    border-color: #0a58ca;
}

.checkout_main-sidebar_summary_submit .icon {
    margin-left: 10px; /* Jarak antara teks dan ikon */
    font-size: 1rem; /* Ukuran ikon */
}

/* Security Message */
.checkout_main-sidebar_summary_security {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
    font-size: 0.85rem;
    color: #6c757d;
    text-align: center;
}

.checkout_main-sidebar_summary_security .icon {
    margin-right: 8px; /* Jarak antara ikon dan teks */
    font-size: 1.1rem; /* Ukuran ikon kunci */
    color: #28a745; /* Warna hijau untuk keamanan */
}

/* Responsive adjustments */
@media (min-width: 992px) { /* Adjust gap for larger screens */
    .checkout_main {
        gap: 30px;
    }
}

@media (max-width: 767.98px) {
    .checkout_main-content,
    .checkout_main-sidebar_summary {
        padding: 20px; /* Kurangi padding di layar kecil */
    }

    .checkout_main-content_form-section_title {
        font-size: 1.4rem; /* Sesuaikan ukuran judul di layar kecil */
    }

    .checkout_main-sidebar_summary-title {
        font-size: 1.3rem;
    }
}
    </style>
@endpush

@php
use Carbon\Carbon;

function calculateNightsBetweenDates($checkInDate, $checkOutDate)
{
    return $checkInDate->diffInDays($checkOutDate);   
}
@endphp

@section('content')


<header class="page">
            <div class="container">
                <ul class="breadcrumbs d-flex flex-wrap align-content-center">
                    <li class="list-item">
                        <a class="link" href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="list-item">
                        <a class="link" href="{{ route('rooms.index') }}">Rooms</a>
                    </li>
                    <li class="list-item">
                        <a class="link" href="{{ route('rooms.show', $booking->room->id) }}">{{ $booking->room->description }}</a>
                    </li>
                    <li class="list-item">
                        <a class="link" href="{{ route('booking.checkout', $booking->booking_reference) }}">Checkout</a>
                    </li>
                </ul>
                <h1 class="page_title">Checkout</h1>
            </div>
        </header>
        <main>

        <section class="checkout section">
            <div class="container">
                <form class="checkout_main d-lg-flex" action="{{ route('booking.process') }}" method="POST" id="checkout-form">
                    <div class="checkout_main-content">
                        <div class="checkout_main-content_form">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                            
                            <!-- Guest Information -->
                            <div class="checkout_main-content_form-section" data-aos="fade-up">
                                <h3 class="checkout_main-content_form-section_title">Guest Information</h3>
                                <div class="checkout_main-content_form-section_content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-group_label" for="name">Name *</label>
                                                <input
                                                    class="form-group_field field required"
                                                    type="text"
                                                    id="name"
                                                    name="name"
                                                    value="{{ old('name', $booking->student->name ?? '') }}"
                                                    required
                                                />
                                                @error('name')
                                                    <span class="form-group_error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-group_label" for="passport">Passport *</label>
                                                <input
                                                    class="form-group_field field required"
                                                    type="text"
                                                    id="passport"
                                                    name="passport"
                                                    value="{{ old('passport', $booking->student->passport ?? '') }}"
                                                    required
                                                />
                                                @error('passport')
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
                                                    value="{{ old('email', $booking->student->email ?? '') }}"
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
                                                    value="{{ old('phone', $booking->student->phone ?? '') }}"
                                                    required
                                                />
                                                @error('phone')
                                                    <span class="form-group_error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <label class="form-group_label" for="date_of_birth">Date of Birth</label>
                                            <input
                                                class="form-group_field field"
                                                id="date_of_birth"
                                                name="date_of_birth"
                                                type="date"
                                                value="{{ old('date_of_birth', $booking->student->date_of_birth ?? '') }}"
                                            />
                                            @error('date_of_birth')
                                                <span class="form-group_error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <label class="form-group_label" for="address">Address</label>
                                            <textarea
                                                class="form-group_field field"
                                                id="address"
                                                name="address"
                                                rows="3"
                                            >{{ old('address', $booking->student->address ?? '') }}</textarea>
                                            @error('address')
                                                <span class="form-group_error">{{ $message }}</span>
                                            @enderror
                                        </div>
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
                                
                                <div class="form-group">
                                        <label class="form-group_label" for="payment_method">Payment Method *</label>
                                        <select
                                            class="form-group_field field required"
                                            id="payment_method"
                                            name="payment_method"
                                            value="{{ old('payment_method', '') }}"
                                            required
                                        >
                                        <option value="">Select Payment Method</option>
                                        <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                        <option value="debit_card" {{ old('payment_method') == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="check" {{ old('payment_method') == 'check' ? 'selected' : '' }}>Check</option>
                                        <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                        <option value="stripe" {{ old('payment_method') == 'stripe' ? 'selected' : '' }}>Stripe</option>
                                        <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                        </select>
                                        @error('payment_method')
                                            <span class="form-group_error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                <div id="card_credit_payment" class="d-none checkout_main-content_form-section_content">
                                    <div class="form-group">
                                        <label class="form-group_label" for="card_number">Card Number *</label>
                                        <input
                                            class="form-group_field field required"
                                            type="text"
                                            id="card_number"
                                            name="card_number"
                                            value="{{ old('card_number', '') }}"
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
                                                    value="{{ old('expiry_date', '') }}"
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
                                                    value="{{ old('cvv', '') }}"
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
                                            value="{{ old('card_holder', '') }}"
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
                        </div>
                    </div>

                    <div class="checkout_main-sidebar">
                        <div class="checkout_main-sidebar_summary" data-aos="fade-left">
                            <h3 class="checkout_main-sidebar_summary-title">Booking Summary</h3>
                            
                            <div class="checkout_main-sidebar_summary_room">
                                <div class="checkout_main-sidebar_summary_room-media">
                                    <img class="checkout_main-sidebar_summary_room-media_img" src="{{ $booking->room->image ? asset($booking->room->image) : asset('img/hero.webp') }}" alt="{{ $booking->room->name }}" />
                                </div>
                                <div class="checkout_main-sidebar_summary_room-content">
                                    <h4 class="checkout_main-sidebar_summary_room-content_title">{{ $booking->room->description }}</h4>
                                    <p class="checkout_main-sidebar_summary_room-content_text">{{ $booking->room->room_type }}</p>
                                </div>
                            </div>

                            <div class="checkout_main-sidebar_summary_details">
                                <div class="checkout_main-sidebar_summary_details_item">
                                    <span class="label">Check-in:</span>
                                    <span class="value">{{ $booking->check_in_date->format('d.m.Y') }}</span>
                                </div>
                                <div class="checkout_main-sidebar_summary_details_item">
                                    <span class="label">Check-out:</span>
                                    <span class="value">{{ $booking->check_out_date->format('d.m.Y') }}</span>
                                </div>
                                <div class="checkout_main-sidebar_summary_details_item">
                                    <span class="label">Guests:</span>
                                    <span class="value">{{ $booking->room->capacity }}</span>
                                </div>
                                <div class="checkout_main-sidebar_summary_details_item">
                                    <span class="label">Nights:</span>
                                    <span class="value">{{ calculateNightsBetweenDates($booking->check_in_date, $booking->check_out_date) }}</span>
                                </div>
                            </div>

                            <div class="checkout_main-sidebar_summary_pricing">
                                <div class="checkout_main-sidebar_summary_pricing_item">
                                    <span class="label">Price per month:</span>
                                    <span class="value">{{ Number::currency($booking->room->price_per_month, env('APP_DEFAULT_CURRENCY', 'IDR')) }}</span>
                                </div>
                                <div class="checkout_main-sidebar_summary_pricing_item">
                                    <span class="label">Subtotal:</span>
                                    <span class="value">{{ Number::currency($booking->subtotal, env('APP_DEFAULT_CURRENCY', 'IDR')) }}</span>
                                </div>
                                @if($booking->tax > 0)
                                <div class="checkout_main-sidebar_summary_pricing_item">
                                    <span class="label">Tax:</span>
                                    <span class="value">{{ Number::currency($booking->tax, env('APP_DEFAULT_CURRENCY', 'IDR')) }}</span>
                                </div>
                                @endif
                                @if($booking->service_fee > 0)
                                <div class="checkout_main-sidebar_summary_pricing_item">
                                    <span class="label">Service Fee:</span>
                                    <span class="value">{{ Number::currency($booking->service_fee, env('APP_DEFAULT_CURRENCY', 'IDR')) }}</span>
                                </div>
                                @endif
                                <div class="checkout_main-sidebar_summary_pricing_item checkout_main-sidebar_summary_pricing_item">
                                    <span class="label">Total:</span>
                                    <span class="value">{{ Number::currency($booking->total_amount, env('APP_DEFAULT_CURRENCY', 'IDR')) }}</span>
                                </div>
                                <div class="checkout_main-sidebar_summary_pricing_item checkout_main-sidebar_summary_pricing_item--total">
                                    <span class="label">Down Payment:</span>
                                    <span class="value">{{ Number::currency($booking->down_payment_amount, env('APP_DEFAULT_CURRENCY', 'IDR')) }}</span>
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
                </form>
            </div>
        </section>
        </main>
@endsection

@push('scripts')
    <script src="{{ asset('asset/js/common.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethodSelect = document.getElementById('payment_method');
            const cardCreditPayment = document.getElementById('card_credit_payment');
            const buttonSubmits = document.querySelectorAll('button[type="submit"]');

            paymentMethodSelect.addEventListener('change', function() {
                if (["credit_card", "debit_card"].includes(this.value)) {
                    cardCreditPayment.classList.remove('d-none');
                } else {
                    cardCreditPayment.classList.add('d-none');
                }
            });

            buttonSubmits.forEach((buttonSubmit) => {
                buttonSubmit.addEventListener('click', function(e) {
                    console.log(e.target);
                    e.target.setAttribute('disabled', true);
                    e.target.closest('form').submit();
                });
            });
        })
    </script>
@endpush 