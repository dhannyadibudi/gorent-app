<?php

namespace App\Http\Controllers\Customer;

use App\Models\Payment;
use App\Services\Payment\PaymentService;
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
}