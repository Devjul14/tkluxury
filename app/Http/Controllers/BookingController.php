<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function search(Request $request)
    {
        // Handle booking search form submission
        if ($request->isMethod('post')) {
            $request->validate([
                'check_in' => 'required|date|after:today',
                'check_out' => 'required|date|after:check_in',
                'guests' => 'required|integer|min:1|max:10',
            ]);

            // Redirect to rooms page with search parameters
            return redirect()->route('rooms.index', $request->all());
        }

        // Show search form
        return view('booking.search');
    }

    public function checkout(Request $request)
    {
        // Sample booking data
        $booking = (object) [
            'id' => 'BK' . strtoupper(uniqid()),
            'room_id' => $request->get('room_id', 1),
            'check_in' => Carbon::parse($request->get('check_in', now()->addDays(1))),
            'check_out' => Carbon::parse($request->get('check_out', now()->addDays(3))),
            'guests' => $request->get('guests', 1),
            'nights' => Carbon::parse($request->get('check_out', now()->addDays(3)))->diffInDays(Carbon::parse($request->get('check_in', now()->addDays(1)))),
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'phone' => '',
            'address' => '',
            'special_requests' => '',
        ];

        // Sample room data
        $room = (object) [
            'id' => $booking->room_id,
            'name' => 'Superior Double Bed Private Ensuite',
            'price' => 89,
            'image' => 'img/room-1.jpg',
        ];

        // Calculate totals
        $booking->subtotal = $room->price * $booking->nights;
        $booking->tax = $booking->subtotal * config('hostel.booking.tax_rate', 0.08);
        $booking->service_fee = $booking->subtotal * config('hostel.booking.service_fee_rate', 0.05);
        $booking->total = $booking->subtotal + $booking->tax + $booking->service_fee;

        return view('booking.checkout', compact('booking', 'room'));
    }

    public function store(Request $request)
    {
        // Handle booking creation
        $request->validate([
            'room_id' => 'required|integer',
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:10',
        ]);

        // Create booking logic here
        // For now, redirect to checkout
        return redirect()->route('booking.checkout', $request->all());
    }

    public function process(Request $request)
    {
        // Handle payment processing
        $request->validate([
            'booking_id' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'card_number' => 'required|string|min:13|max:19',
            'expiry_date' => 'required|string',
            'cvv' => 'required|string|min:3|max:4',
            'card_holder' => 'required|string|max:255',
            'terms' => 'required|accepted',
        ]);

        // Process payment logic here
        // For demo purposes, we'll simulate a successful payment

        // Create booking confirmation
        $booking = (object) [
            'id' => $request->booking_id ?: 'BK' . strtoupper(uniqid()),
            'booking_number' => 'BK' . strtoupper(uniqid()),
            'room' => (object) [
                'id' => $request->get('room_id', 1),
                'name' => 'Superior Double Bed Private Ensuite',
                'image' => 'img/room-1.jpg',
            ],
            'check_in' => Carbon::parse($request->get('check_in', now()->addDays(1))),
            'check_out' => Carbon::parse($request->get('check_out', now()->addDays(3))),
            'guests' => $request->get('guests', 1),
            'nights' => Carbon::parse($request->get('check_out', now()->addDays(3)))->diffInDays(Carbon::parse($request->get('check_in', now()->addDays(1)))),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'special_requests' => $request->special_requests,
            'subtotal' => 89 * (Carbon::parse($request->get('check_out', now()->addDays(3)))->diffInDays(Carbon::parse($request->get('check_in', now()->addDays(1))))),
            'tax' => 0,
            'service_fee' => 0,
            'total' => 89 * (Carbon::parse($request->get('check_out', now()->addDays(3)))->diffInDays(Carbon::parse($request->get('check_in', now()->addDays(1))))),
            'payment_status' => 'paid',
            'booking_status' => 'confirmed',
            'created_at' => now(),
        ];

        // Store booking in session for confirmation page
        session(['booking_confirmation' => $booking]);

        return redirect()->route('booking.confirmation');
    }

    public function confirmation()
    {
        // Get booking from session
        $booking = session('booking_confirmation');

        if (!$booking) {
            return redirect()->route('home');
        }

        // Clear session
        session()->forget('booking_confirmation');

        return view('booking.confirmation', compact('booking'));
    }

    public function download($id)
    {
        // Generate PDF receipt
        // For demo purposes, redirect to confirmation page
        return redirect()->route('booking.confirmation');
    }
} 