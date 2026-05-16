<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\PaymentStatusEnum;

class Payment extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'booking_id',
        'payment_gateway',
        'payment_reference',
        'amount',
        'status',
        'payload',
        'paid_at',
        'expired_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
        'status' => PaymentStatusEnum::class,
    ];

    public function booking()
    {
        return $this->belongsTo(
            Booking::class
        );
    }
}