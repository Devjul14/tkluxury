<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'room_id' => 'required|integer',
            'check_in' => 'required|date_format:m.d.Y|after:today',
            'check_out' => 'required|date_format:m.d.Y|after:check_in',
        ], [], [
            'room_id' => 'room',
            'check_in' => 'check-in',
            'check_out' => 'check-out',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // If validation passes, continue with your logic
        $data = $validator->validated();
        // dd($data);
        $user = Auth::user();

        // Create booking logic here
        $room = Room::with('property')->findOrFail($data['room_id']);
        $checkInCarbon = Carbon::createFromFormat('m.d.Y', $data['check_in']);
        $checkOutCarbon = Carbon::createFromFormat('m.d.Y', $data['check_out']);

        $bookingReference = "BOOK-" . $checkInCarbon->format('YmdHis') . "-" . str_pad($room->id, 5, '0', STR_PAD_LEFT);
        $durationMonths = $checkOutCarbon->diffInMonths($checkInCarbon);
        $totalAmount = $room->price_per_month * $durationMonths;
        
        $booking = Booking::create([
            "student_id" => $user->id,
            "nights" => $checkOutCarbon->diffInDays($checkInCarbon),
            "property_id" => $room->property_id,
            "room_id" => $room->id,
            "duration_months" => $durationMonths,
            "booking_date" => now(),
            "check_in_date" => $checkInCarbon,
            "check_out_date" => $checkOutCarbon,
            "status" => "pending",
            "booking_reference" => $bookingReference,
            "security_deposit" => $room->property->security_deposit,
            "monthly_rent" => $room->price_per_month,
            "subtotal" => $totalAmount,
            "tax" => ($totalAmount) * config('hostel.booking.tax_rate', 0.08),
            "service_fee" => ($totalAmount) * config('hostel.booking.service_fee_rate', 0.05),
            "total_amount" => $totalAmount + (($totalAmount) * config('hostel.booking.tax_rate', 0.08)) + (($totalAmount) * config('hostel.booking.service_fee_rate', 0.05)),
        ]);

        // $booking = collect([
        //     "nights" => $checkOutCarbon->diffInDays($checkInCarbon),
        //     "property_id" => $room->property_id,
        //     "room_id" => $room->id,
        //     "check_in_date" => $checkInCarbon,
        //     "check_out_date" => $checkOutCarbon,
        //     "status" => "pending",
        //     "booking_reference" => $bookingReference,
        //     "subtotal" => $room->price * $checkOutCarbon->diffInDays($checkInCarbon),
        //     "tax" => ($room->price * $checkOutCarbon->diffInDays($checkInCarbon)) * config('hostel.booking.tax_rate', 0.08),
        //     "service_fee" => ($room->price * $checkOutCarbon->diffInDays($checkInCarbon)) * config('hostel.booking.service_fee_rate', 0.05),
        //     "total" => ($room->price * $checkOutCarbon->diffInDays($checkInCarbon)) + (($room->price * $checkOutCarbon->diffInDays($checkInCarbon)) * config('hostel.booking.tax_rate', 0.08)) + (($room->price * $checkOutCarbon->diffInDays($checkInCarbon)) * config('hostel.booking.service_fee_rate', 0.05)), // Sum up correctly
        // ]);
        $data['booking'] = $booking;
        $data['room'] = $room;

         \Log::info('Success store booking');

        // For now, redirect to checkout
        return redirect()->route('booking.checkout', [
            $booking->booking_reference,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
        ]);
    }

    public function checkout(string $bookingReference,Request $request)
    {
        $booking = Booking::with(['room', 'student'])
            ->where('booking_reference', $bookingReference)
            ->firstOrFail();
        
        return view('booking.checkout', [
            'booking' => $booking,
        ]);
    }

    public function checkout_(Request $request)
    {
        // dd($request);
        // Sample booking data
        $booking = (object) [
            'id' => 'BK' . strtoupper(uniqid()),
            'room_id' => $request->get('room_id', 1),
            'check_in_date' => Carbon::parse($request->get('check_in', now()->addDays(1))),
            'check_out_date' => Carbon::parse($request->get('check_out', now()->addDays(3))),
            'guests' => $request->get('guests', 1),
            'nights' => Carbon::parse($request->get('check_out', now()->addDays(3)))->diffInDays(Carbon::parse($request->get('check_in', now()->addDays(1)))),
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'phone' => '',
            'address' => '',
            'special_requests' => '',
            'booking_reference' => '',
            'security_deposit' => 33,
        ];

        // Sample room data
        $room = (object) [
            'id' => $booking->room_id,
            'name' => 'Superior Double Bed Private Ensuite',
            'description' => 'Desc',
            'type' => 'type',
            'price' => 89,
            'image' => 'img/hero.webp',            
            'price_per_month' => 100,
        ];

        // Sample student data
        $student = (object) [
            'id' => $booking->room_id,
            'name' => 'julia',
            'passport' => '0000',
            'email' => 'julia@gmail.com',
            'phone' => '000089',
            'date_of_birth' => '2025-01-01',
            'address' => 'test',
            'special_requests' => 'test',
            'image' => 'img/hero.webp',
        ];

        // Calculate totals
        $booking->subtotal = $room->price * $booking->nights;
        $booking->tax = $booking->subtotal * config('hostel.booking.tax_rate', 0.08);
        $booking->service_fee = $booking->subtotal * config('hostel.booking.service_fee_rate', 0.05);
        $booking->total = $booking->subtotal + $booking->tax + $booking->service_fee;
        $total_amount = $booking->total;

        return view('booking.checkout', compact('booking', 'room','student','total_amount'));
    }


    public function process(Request $request)
    {
        dd($request);
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