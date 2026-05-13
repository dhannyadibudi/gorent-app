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
            $payment->status === 'paid'
        ) {

            return back();
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