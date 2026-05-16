<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use App\Services\Payment\PaymentService;
use App\Services\MidtransService;
use Midtrans\Notification;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymentService $paymentService
    ) {}

    public function simulate(
        Payment $payment
    ) {

        if (
            $payment->status !== 'pending'
        ) {

            return back()->with(
                'error',
                'Payment is no longer valid.'
            );
        }

        if (
            $payment->expired_at < now()
        ) {

            $payment->update([
                'status' => 'expired',
            ]);

            $payment->booking()->update([
                'status' => 'expired',
            ]);

            return back()->with(
                'error',
                'Payment has expired.'
            );
        }

        $this->paymentService
            ->markAsPaid(
                $payment
            );

        return redirect()
            ->back()
            ->with(
                'success',
                'Payment success'
            );
    }

    public function snapToken(
    Booking $booking,
    MidtransService $midtransService
    ) {

        abort_if(
            $booking->user_id !== auth()->id(),
            403
        );

        $booking->load('user');

        $snapToken = $midtransService
            ->createTransaction($booking);

        return response()->json([
            'snap_token' => $snapToken,
        ]);
    }

    public function callback(Request $request)
    {
        \Midtrans\Config::$serverKey =
            config('midtrans.server_key');

        \Midtrans\Config::$isProduction =
            config('midtrans.is_production');

        \Midtrans\Config::$isSanitized = true;

        \Midtrans\Config::$is3ds = true;

        $notification = new \Midtrans\Notification();

        $transactionStatus =
            $notification->transaction_status;

        $orderId =
            $notification->order_id;

        $payment = Payment::whereHas(
            'booking',
            fn ($query) =>
                $query->where(
                    'invoice_number',
                    $orderId
                )
        )->first();

        if (!$payment) {

            return response()->json([
                'message' => 'Payment not found'
            ], 404);

        }

        if (
            in_array(
                $transactionStatus,
                ['capture', 'settlement']
            )
        ) {

            $payment->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

        }

        if (
            in_array(
                $transactionStatus,
                ['expire', 'cancel', 'deny']
            )
        ) {

            $payment->update([
                'status' => 'failed',
            ]);

        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function status(Booking $booking)
    {
        return response()->json([
            'status' => $booking
                ->payment
                ?->status ?? 'pending',
        ]);
    }
}