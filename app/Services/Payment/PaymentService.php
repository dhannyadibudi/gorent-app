<?php

namespace App\Services\Payment;

use App\Models\Booking;
use App\Models\Payment;
use App\Services\Payment\Contracts\PaymentGatewayInterface;

class PaymentService
{
    public function __construct(
        protected PaymentGatewayInterface $gateway
    ) {}

    public function create(
        Booking $booking
    ): array {

        return $this->gateway
            ->createTransaction(
                $booking
            );
    }

    public function markAsPaid(
    Payment $payment
    ): Payment {

        $payment->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        $payment->booking()->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return $payment->fresh();
    }
}