<?php

namespace App\Services;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Booking;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config(
            'midtrans.server_key'
        );

        Config::$isProduction = config(
            'midtrans.is_production'
        );

        Config::$isSanitized = true;

        Config::$is3ds = true;
    }

    public function createTransaction(
        Booking $booking
    ) {

        return Snap::getSnapToken([

            'transaction_details' => [

                'order_id' => $booking->invoice_number,

                'gross_amount' => (int)
                    $booking->total_price,

            ],

            'customer_details' => [

                'first_name' => $booking->user->name,

                'email' => $booking->user->email,

                'phone' => $booking->user->phone,

            ],

        ]);
    }
}