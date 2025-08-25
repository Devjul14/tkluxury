<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Razorpay\Api\Api;

class RazorpayPaymentController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        return view('razorpay');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (!empty($input['razorpay_payment_id'])) {
            try {
                $response = $api
                    ->payment
                    ->fetch($input['razorpay_payment_id'])
                    ->capture(['amount' => $payment['amount']]);
                $razorResponseStatus = $response['status'];

                $payment = Payment::create([
                    'booking_id' => $input['booking_id'],
                    'payment_type' => 'razorpay',
                    'amount' => $response['amount'],
                    'payment_method' => 'razorpay',
                    'payment_status' => in_array($razorResponseStatus, ['authorized', 'captured']) ? 'completed' : 'failed',
                    'transaction_id' => $response['id'],
                    'payment_date' => now(),
                    'due_date' => now()->addDays(1),
                    'late_fee_applied' => false,
                ]);

                return redirect()
                    ->route('razorpay.payment.callback')
                    ->with('payment', $payment);
            } catch (\Exception $e) {
                return redirect()
                    ->back()
                    ->with('error', $e->getMessage());
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Payment successful');
    }

    public function callback(): View
    {
        $paymentInSession = session('payment');

        if (!$paymentInSession) {
            return abort(404);
        }

        $payment = Payment::with('booking')->where('id', $paymentInSession->id)->firstOrFail();

        session()->forget(['booking_confirmation', 'booking']);

        // $payment = new Payment([
        //     'booking_id' => 1,
        //     'payment_type' => 'razorpay',
        //     'amount' => 100,
        //     'payment_method' => 'razorpay',
        //     'payment_status' => 'completed',
        //     'transaction_id' => '1234567890',
        //     'payment_date' => now(),
        //     'due_date' => now()->addDays(1),
        //     'late_fee_applied' => false,
        // ]);

        // $booking = Booking::with('student')->first();
        // $payment->setRelation('booking', $booking);
        return view('payment.callback', compact('payment'));
    }
}
