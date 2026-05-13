<?php

namespace App\Services\Payment\Contracts;

use App\Models\Booking;

interface PaymentGatewayInterface
{
    public function createTransaction(
        Booking $booking
    ): array;
}