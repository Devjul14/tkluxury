<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

        $bookingReference = 'BOOK-' . $checkInCarbon->format('YmdHis') . '-' . str_pad($room->id, 5, '0', STR_PAD_LEFT);
        $durationMonths = $checkInCarbon->diffInMonths($checkOutCarbon);
        $totalRentAmount = $room->price_per_month * $durationMonths;
        $totalAmount = $totalRentAmount + (($totalRentAmount) * config('hostel.booking.tax_rate', 0.08)) + (($totalRentAmount) * config('hostel.booking.service_fee_rate', 0.05));

        $booking = new Booking([
            'property_id' => $room->property_id,
            'room_id' => $room->id,
            'duration_months' => $durationMonths,
            'booking_date' => now(),
            'check_in_date' => $checkInCarbon,
            'check_out_date' => $checkOutCarbon,
            'status' => 'pending',
            'booking_reference' => $bookingReference,
            'security_deposit' => $room->property->security_deposit,
            'monthly_rent' => $room->price_per_month,
            'subtotal' => $totalRentAmount,
            'down_payment_amount' => $totalRentAmount * config('hostel.booking.down_payment_rate', 0.1),
            'tax' => ($totalRentAmount) * config('hostel.booking.tax_rate', 0.08),
            'service_fee' => ($totalRentAmount) * config('hostel.booking.service_fee_rate', 0.05),
            'total_amount' => $totalAmount,
        ]);

        $booking->setRelation('room', $room);

        // dd($booking->toArray());
        session()->put('booking', $booking);


        // For now, redirect to checkout
        return redirect()->route('booking.checkout', [
            $booking->booking_reference,
        ]);
    }

    public function checkout(string $bookingReference, Request $request)
    {
        $booking = Booking::with(['room', 'student'])
            ->where('booking_reference', $bookingReference)
            ->first() ?? session()->get('booking');

        if (!$booking) {
            abort(404);
        }

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

        return view('booking.checkout', compact('booking', 'room', 'student', 'total_amount'));
    }

    public function process(Request $request)
    {
        // Handle payment processing
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'card_number' => 'required|string|min:13|max:19',
            'expiry_date' => 'required|string',
            'cvv' => 'required|string|min:3|max:4',
            'card_holder' => 'required|string|max:255',
            'terms' => 'required|accepted',
            'date_of_birth' => 'required|date',
        ]);

        $booking = session()->get('booking');

        // create student data
        $student = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'),
            'phone' => $request->phone,
            'user_type' => 'student',
            'profile_image' => null,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'emergency_contact_name' => null,
            'emergency_contact_phone' => null,
            'is_active' => false,
            'password' => ucwords(Str::random(8)) . str_pad(random_int(1, 100), 2, '0', STR_PAD_LEFT),
        ]);

        $booking->setRelation('student', $student);

        // Store booking in session for confirmation page
        session(['booking_confirmation' => $booking]);

        return redirect()->route('booking.confirmation');
    }

    public function confirmation()
    {
        // Get booking from session
        $booking = session()->get('booking_confirmation');
        $booking->student->save();
        $student = $booking->student->fresh();

        $booking->student_id = $student->id;
        $booking->save();

        if (!$booking) {
            return redirect()->route('home');
        }

        // Clear session
        // session()->forget('booking_confirmation');

        return view('booking.confirmation', compact('booking'));
    }

    public function download($id)
    {
        // Generate PDF receipt
        // For demo purposes, redirect to confirmation page
        return redirect()->route('booking.confirmation');
    }
}
