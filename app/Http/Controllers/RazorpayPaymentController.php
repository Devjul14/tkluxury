<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

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
        Log::info('Razorpay Store - Request Input:', $input);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        Log::info('Razorpay API Initialized');

        if (!empty($input['razorpay_payment_id'])) {
            try {
                $payment = $api->payment->fetch($input['razorpay_payment_id']);
                Log::info('Fetched Razorpay Payment:', $payment->toArray());

                $response = $payment->capture(['amount' => $payment['amount']]);
                Log::info('Captured Razorpay Payment:', $response->toArray());

                $razorResponseStatus = $response['status'];
                Log::info('Razorpay Payment Status: ' . $razorResponseStatus);

                // disini tambahkan Payment reference dan status
                $payment = Payment::create([
                    'booking_id' => $input['booking_id'] ?? null,
                    'payment_type' => 'monthly_rent',
                    'amount' => $response['amount'],
                    'payment_method' => 'credit_card',
                    'payment_status' => in_array($razorResponseStatus, ['authorized', 'captured']) ? 'completed' : 'failed',
                    'transaction_id' => $response['id'],
                    'payment_date' => now(),
                    'due_date' => now()->addDays(1),
                    'late_fee_applied' => false,
                ]);

                Log::info('Payment record created in DB:', $payment->toArray());

                return redirect()
                    ->route('razorpay.payment.callback')
                    ->with('payment', $payment);
            } catch (\Exception $e) {
                Log::error('Razorpay Payment Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

                return redirect()
                    ->back()
                    ->with('error', $e->getMessage());
            }
        }

        Log::warning('No razorpay_payment_id found in request.');
        return redirect()
            ->back()
            ->with('success', 'Payment successful');
    }

    public function callback(): View
    {
        $paymentInSession = session('payment');
        Log::info('Callback session payment:', ['payment' => $paymentInSession]);

        if (!$paymentInSession) {
            Log::warning('Callback called without payment in session.');
            return abort(404);
        }

        $payment = Payment::with('booking')->where('id', $paymentInSession->id)->firstOrFail();
        Log::info('Payment loaded from DB in callback:', $payment->toArray());

        session()->forget(['booking_confirmation', 'booking']);

        return view('payment.callback', compact('payment'));
    }
}
