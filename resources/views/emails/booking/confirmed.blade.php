@extends('emails.layouts.base')

@use('Carbon\Carbon')
@use('Illuminate\Support\Str')

@section('content')
<div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="icon">✓</div>
            <h1>Booking Confirmed!</h1>
            <p>Thank you for your reservation. Here's your booking confirmation.</p>
        </div>
        
        <!-- Content -->
        <div class="email-content">
            <!-- Booking Summary -->
            <div class="booking-summary">
                <div class="booking-header">
                    <div class="booking-number">Booking #{{ $booking->booking_reference }}</div>
                    <div class="booking-status">Confirmed</div>
                </div>
                
                @if($booking->room)
                <div class="room-info">
                    <div class="room-image">
                        <img src="{{ $booking->room->image }}" alt="{{ $booking->room->name }}">
                    </div>
                    <div class="room-details">
                        <h3>{{ $booking->room->name }}</h3>
                        <p>{{ $booking->room->room_type }}</p>
                    </div>
                </div>
                @endif
                
                @if($booking->property)
                <div class="room-info">
                    <div class="room-image">
                        <img src="{{ $booking->property->getThumbnailAttribute() ? asset($booking->property->getThumbnailAttribute()) : asset('img/hero.webp') }}" alt="{{ $booking->property->name }}">
                    </div>
                    <div class="room-details">
                        <h3>{{ $booking->property->title }}</h3>
                        <p>{{ $booking->property->property_type }}</p>
                    </div>
                </div>
                @endif
                <div class="booking-details">
                    <div class="detail-row">
                        <span class="detail-label">Check-in:</span>
                        <span class="detail-value">{{ Carbon::parse($booking->check_in_date)->format('l, M d, Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Check-out:</span>
                        <span class="detail-value">{{ Carbon::parse($booking->check_out_date)->format('l, M d, Y') }}</span>
                    </div>
                    @if($booking->room)
                    <div class="detail-row">
                        <span class="detail-label">Guests:</span>
                        <span class="detail-value">{{ $booking->room->capacity }} {{ Str::plural('person', $booking->room->capacity) }}</span>
                    </div>
                    @endif
                    <div class="detail-row">
                        <span class="detail-label">Nights:</span>
                        <span class="detail-value">{{ Carbon::parse($booking->check_in_date)->diffInDays(Carbon::parse($booking->check_out_date)) }}</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="detail-label">Price per month:</span>
                        <span class="detail-value">${{ number_format($booking->monthly_rent, 2) }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Subtotal:</span>
                        <span class="detail-value">${{ number_format($booking->subtotal, 2) }}</span>
                    </div>
                    @if($booking->tax > 0)
                    <div class="detail-row">
                        <span class="detail-label">Tax:</span>
                        <span class="detail-value">${{ number_format($booking->tax, 2) }}</span>
                    </div>
                    @endif
                    @if($booking->service_fee > 0)
                    <div class="detail-row">
                        <span class="detail-label">Service Fee:</span>
                        <span class="detail-value">${{ number_format($booking->service_fee, 2) }}</span>
                    </div>
                    @endif
                    <div class="detail-row total-row">
                        <span class="detail-label">Total:</span>
                        <span class="detail-value">${{ number_format($booking->total_amount, 2) }}</span>
                    </div>
                    <div class="detail-row total-row">
                        <span class="detail-label">Down Payment:</span>
                        <span class="detail-value">${{ number_format($booking->down_payment_amount, 2) }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Guest Information -->
            <div class="guest-info">
                <h3 class="section-title">Account Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value">{{ $booking->student->name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{ $booking->student->email }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Password:</span>
                    <span class="detail-value">{{ $password }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value">{{ $booking->student->phone }}</span>
                </div>
                @if($booking->student->address)
                <div class="detail-row">
                    <span class="detail-label">Address:</span>
                    <span class="detail-value">{{ $booking->student->address }}</span>
                </div>
                @endif
            </div>
            
            <!-- Special Requests -->
            @if($booking->special_requests)
            <div class="special-requests">
                <h3 class="section-title">Special Requests</h3>
                <p>{{ $booking->special_requests }}</p>
            </div>
            @endif
            
            <!-- Next Steps -->
            <div class="next-steps">
                <h3 class="section-title">What's Next?</h3>
                
                <div class="step">
                    <div class="step-content">
                        <h4>Check-in Time</h4>
                        <p>Check-in is available from 2:00 PM on your arrival date.</p>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-content">
                        <h4>Need Help?</h4>
                        <p>Contact us at {{ config('contact.phone.primary') }} or {{ config('contact.email.primary') }} for any questions.</p>
                    </div>
                </div>
            </div>

            <div class="next-steps">
                <h3 class="section-title">Services</h3>
                
                @foreach ($booking->services as $service)
                <div class="step">
                    <div class="step-content">
                        <h4>{{ $service->title }}</h4>
                        <p>{{ $service->price }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Footer -->
        <div class="email-footer">
            <div class="footer-logo">
                <img src="https://via.placeholder.com/150x50?text=Your+Logo" alt="Company Logo" width="150">
            </div>
            
            <div class="footer-links">
                <a href="#">Website</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
            
            <div class="social-icons">
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
                <a href="#">Instagram</a>
            </div>
            
            <p>© {{ date('Y') }} Your Company Name. All rights reserved.</p>
            <p>{{ config('contact.address.line1') }}, {{ config('contact.address.line2') }}</p>
        </div>
    </div>
@endsection
