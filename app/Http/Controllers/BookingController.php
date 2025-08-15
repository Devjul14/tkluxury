<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmed;
use App\Models\Booking;
use App\Models\Property;
use App\Models\Room;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            'room_id' => 'sometimes|integer|exists:rooms,id',
            'property_id' => 'sometimes|integer|exists:properties,id',
            'check_in' => 'required|date_format:m.d.Y|after:today',
            'check_out' => 'required|date_format:m.d.Y|after:check_in',
            'services' => 'array',
            'services.*' => 'exists:services,id',
        ], [], [
            'room_id' => 'room',
            'property_id' => 'property',
            'check_in' => 'check-in',
            'check_out' => 'check-out',
        ]);

        $validator->after(function ($validator) {
            $data = $validator->getData();
            if (empty($data['room_id']) && empty($data['property_id'])) {
                $validator->errors()->add('room_id', 'Either a room or a property must be selected for booking.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation passes, continue with your logic
        $data = $validator->validated();
        $user = Auth::user();
        $checkInCarbon = Carbon::createFromFormat('m.d.Y', $data['check_in']);
        $checkOutCarbon = Carbon::createFromFormat('m.d.Y', $data['check_out']);

        $booking = new Booking([
            'property_id' => $data['property_id'] ?? null,
            'room_id' => $data['room_id'] ?? null,
            'booking_date' => now(),
            'check_in_date' => $checkInCarbon,
            'check_out_date' => $checkOutCarbon,
            'status' => 'pending',
        ]);

        $services = collect();
        if (isset($data['room_id'])) {
            $room = Room::with('property')->findOrFail($data['room_id']);
            $bookingReference = 'BOOK-' . $checkInCarbon->format('YmdHis') . '-' . str_pad($room->id, 5, '0', STR_PAD_LEFT);
            $durationMonths = $checkInCarbon->diffInMonths($checkOutCarbon);
            $totalRentAmount = $room->price_per_month * $durationMonths;
            $totalAmount = $totalRentAmount + (($totalRentAmount) * config('hostel.booking.tax_rate', 0.08)) + (($totalRentAmount) * config('hostel.booking.service_fee_rate', 0.05));

            $services = Service::whereIn('id', $data['services'] ?? [])->get();
            $serviceFees = $services->sum('price');
            $booking->duration_months = $durationMonths;
            $booking->booking_reference = $bookingReference;
            $booking->security_deposit = $room->property->security_deposit;
            $booking->monthly_rent = $room->price_per_month;
            $booking->subtotal = $totalRentAmount;

            if ($room->property->down_payment_type === 'percentage') {
                $booking->down_payment_amount = $totalRentAmount * ($room->property->down_payment_value / 100);
            } elseif ($room->property->down_payment_type === 'fixed') {
                $booking->down_payment_amount = $room->property->down_payment_value;
            } else {
                $booking->down_payment_amount = $totalRentAmount * config('hostel.booking.down_payment_rate', 0.1);
            }

            $booking->tax = ($totalRentAmount) * config('hostel.booking.tax_rate', 0.08);
            $booking->service_fee = (($totalRentAmount) * config('hostel.booking.service_fee_rate', 0.05)) + $serviceFees;
            $booking->total_amount = $totalAmount;
            $booking->setRelation('room', $room);
        }

        if (isset($data['property_id'])) {
            $property = Property::with('rooms')->findOrFail($data['property_id']);
            $bookingReference = 'BOOK-' . $checkInCarbon->format('YmdHis') . '-' . str_pad($property->property_code, 5, '0', STR_PAD_LEFT);
            $durationMonths = $checkInCarbon->diffInMonths($checkOutCarbon);
            $totalRentAmount = $property->price_per_month * $durationMonths;
            $totalAmount = $totalRentAmount + (($totalRentAmount) * config('hostel.booking.tax_rate', 0.08)) + (($totalRentAmount) * config('hostel.booking.service_fee_rate', 0.05));

            $services = Service::whereIn('id', $data['services'] ?? [])->get();
            $serviceFees = $services->sum('price');
            $booking->duration_months = $durationMonths;
            $booking->booking_reference = $bookingReference;
            $booking->security_deposit = $property->security_deposit;
            $booking->monthly_rent = $property->price_per_month;
            $booking->subtotal = $totalRentAmount;
            if ($property->down_payment_type === 'percentage') {
                $booking->down_payment_amount = $totalRentAmount * ($property->down_payment_value / 100);
            } elseif ($property->down_payment_type === 'fixed') {
                $booking->down_payment_amount = $property->down_payment_value;
            } else {
                $booking->down_payment_amount = $totalRentAmount * config('hostel.booking.down_payment_rate', 0.1);
            }
            $booking->tax = ($totalRentAmount) * config('hostel.booking.tax_rate', 0.08);
            $booking->service_fee = (($totalRentAmount) * config('hostel.booking.service_fee_rate', 0.05)) + $serviceFees;
            $booking->total_amount = $totalAmount;
            $booking->setRelation('property', $property);
        }
        $booking->setRelation('services', $services);

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
        $services = Service::query()
            ->where('status', 'active')
            ->orderBy('title', 'asc')
            ->get();

        if (!$booking) {
            abort(404);
        }

        return view('booking.checkout', [
            'booking' => $booking,
            'services' => $services,
        ]);
    }

    public function process(Request $request)
    {
        // Handle payment processing
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'special_requests' => 'nullable|string|max:255',
            'payment_method' => 'required|in:debit_card,credit_card,cash,paypal,bank_transfer',
            // Card fields (only checked if payment is card-based)
            'card_number' => [
                'nullable',  // Allows empty values
                'required_if:payment_method,debit_card,credit_card',  // Required only for cards
                'string',
                'min:13',
                'max:19',
                function ($attribute, $value, $fail) use ($request) {
                    if (in_array($request->payment_method, ['debit_card', 'credit_card']) && !preg_match('/^[0-9]{13,19}$/', $value)) {
                        $fail('Invalid card number. Must be 13-19 digits.');
                    }
                },
            ],
            'expiry_date' => [
                'nullable',
                'required_if:payment_method,debit_card,credit_card',
                'string',
                function ($attribute, $value, $fail) use ($request) {
                    if (in_array($request->payment_method, ['debit_card', 'credit_card']) && !preg_match('/^(0[1-9]|1[0-2])\/?([0-9]{2})$/', $value)) {
                        $fail('Expiry date must be in MM/YY format.');
                    }
                },
            ],
            'cvv' => [
                'nullable',
                'required_if:payment_method,debit_card,credit_card',
                'string',
                'min:3',
                'max:4',
                function ($attribute, $value, $fail) use ($request) {
                    if (in_array($request->payment_method, ['debit_card', 'credit_card']) && !preg_match('/^[0-9]{3,4}$/', $value)) {
                        $fail('CVV must be 3 or 4 digits.');
                    }
                },
            ],
            'card_holder' => [
                'nullable',
                'required_if:payment_method,debit_card,credit_card',
                'string',
                'max:255',
            ],
            // Other payment methods (example)
            'paypal_email' => 'nullable|required_if:payment_method,paypal|email',
            'bank_account' => 'nullable|required_if:payment_method,bank_transfer|string',
            // Misc
            'terms' => 'required|accepted',
            'date_of_birth' => 'required|date|before:-18 years',
            'services' => 'array',
            'services.*' => 'exists:services,id',
        ]);

        // Remove card data if payment is not card-based
        if (!in_array($validated['payment_method'], ['debit_card', 'credit_card'])) {
            $validated = array_diff_key($validated, array_flip([
                'card_number',
                'expiry_date',
                'cvv',
                'card_holder'
            ]));
        }

        $services = Service::whereIn('id', $validated['services'] ?? [])->get();
        $booking = session()->get('booking');
        $booking->setRelation('services', $services);
        $booking->special_requests = $request->special_requests;

        $serviceFees = $services->sum('price');
        $booking->service_fee = (($booking->subtotal) * config('hostel.booking.service_fee_rate', 0.05)) + $serviceFees;

        // create student data
        $generatedPassword = Str::random(8) . str_pad(random_int(1, 100), 2, '0', STR_PAD_LEFT);
        $student = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($generatedPassword),
            'phone' => $request->phone,
            'user_type' => 'student',
            'profile_image' => null,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'emergency_contact_name' => null,
            'emergency_contact_phone' => null,
            'is_active' => false,
        ]);

        $booking->setRelation('student', $student);

        // Store booking in session for confirmation page
        session(['booking_confirmation' => $booking]);

        Mail::to($booking->student->email)->send(new BookingConfirmed($booking, $generatedPassword, $booking->services));

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
        return view('booking.confirmation', compact('booking'));
    }

    public function download($id)
    {
        // Generate PDF receipt
        // For demo purposes, redirect to confirmation page
        return redirect()->route('booking.confirmation');
    }
}
