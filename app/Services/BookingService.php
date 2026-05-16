<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\Payment\PaymentService;

class BookingService
{
    public function __construct(
        protected PaymentService $paymentService
    ) {}

    public function create(
        User $user,
        string $scheduleId
    ) {

        return DB::transaction(function () use (
            $user,
            $scheduleId
        ) {

            $schedule = Schedule::query()
                ->lockForUpdate()
                ->with([
                    'court',
                ])
                ->findOrFail($scheduleId);

            if ($schedule->is_booked) {
                abort(
                    422,
                    'Schedule already booked'
                );
            }

            $booking = Booking::create([
                'user_id' => $user->id,
                'schedule_id' => $schedule->id,
                'invoice_number' =>
                    'INV-' .
                    now()->format('YmdHis') .
                    '-' .
                    Str::upper(
                        Str::random(5)
                    ),
                'total_price' =>
                    $schedule->court->price_per_hour,
                'expired_at' =>
                    Carbon::now()
                        ->addMinutes(15),
            ]);

            $schedule->update([
                'is_booked' => true,
            ]);

            $payment = $this->paymentService
                ->create($booking);
            
            return [
                'booking' => $booking,
                'payment' => $payment,
            ];
        });
    }

    public function cancel(Booking $booking): Booking
    {
        DB::transaction(function () use ($booking) {

            $booking->update([
                'status' => BookingStatusEnum::CANCELLED
            ]);

            if ($booking->payment) {
                $booking->payment->update([
                    'status' => 'failed'
                ]);
            }
        });

        return $booking->fresh();
    }

    public function complete(Booking $booking): Booking
    {
        DB::transaction(function () use ($booking) {

            $booking->update([
                'status' => BookingStatusEnum::COMPLETED
            ]);
        });

        return $booking->fresh();
    }
}