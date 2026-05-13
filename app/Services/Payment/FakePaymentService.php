<?php

namespace App\Services\Payment;

use App\Models\Booking;
use App\Models\Payment;
use App\Services\Payment\Contracts\PaymentGatewayInterface;

class FakePaymentService
implements PaymentGatewayInterface
{
    public function createTransaction(
        Booking $booking
    ): array {

        $payment = Payment::create([

            'booking_id' =>
                $booking->id,

            'payment_gateway' =>
                'fake',

            'payment_reference' =>
                fake()->uuid(),

            'amount' =>
                $booking->total_price,

            'status' =>
                'pending',

            'expired_at' =>
                now()->addMinutes(15),

            'payload' => [
                'mode' => 'fake',
            ],

        ]);

        return [
            'payment_id' =>
                $payment->id,

            'redirect_url' =>
                route(
                    'customer.booking.payment',
                    $booking->id
                ),
        ];
    }
}