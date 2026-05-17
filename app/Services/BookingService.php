<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Enums\BookingStatusEnum;
use App\Enums\PaymentStatusEnum;

use App\Services\Payment\PaymentService;

use App\Notifications\BookingCreatedNotification;

class BookingService
{
    public function __construct(
        protected PaymentService $paymentService
    ) {}

    public function create(
        User $user,
        string $scheduleId
    ): array {

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

            /*
            |--------------------------------------------------------------------------
            | Prevent Double Booking
            |--------------------------------------------------------------------------
            */

            if ($schedule->is_booked) {

                abort(
                    422,
                    'Schedule already booked'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Create Booking
            |--------------------------------------------------------------------------
            */

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

                'status' =>
                    BookingStatusEnum::PENDING_PAYMENT,

                'expired_at' =>
                    Carbon::now()
                        ->addMinutes(15),
            ]);

            /*
            |--------------------------------------------------------------------------
            | Lock Schedule
            |--------------------------------------------------------------------------
            */

            $schedule->update([
                'is_booked' => true,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Create Payment
            |--------------------------------------------------------------------------
            */

            $payment = $this->paymentService
                ->create($booking);

            /*
            |--------------------------------------------------------------------------
            | Load Relations
            |--------------------------------------------------------------------------
            */

            $booking->load([
                'user',
                'schedule.court.gor',
                'payment',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Send Notification
            |--------------------------------------------------------------------------
            */

            $booking->user->notify(
                new BookingCreatedNotification($booking)
            );

            return [
                'booking' => $booking,
                'payment' => $payment,
            ];
        });
    }

    public function cancel(
        Booking $booking
    ): Booking {

        DB::transaction(function () use (
            $booking
        ) {

            /*
            |--------------------------------------------------------------------------
            | Update Booking
            |--------------------------------------------------------------------------
            */

            $booking->update([
                'status' =>
                    BookingStatusEnum::CANCELLED
            ]);

            /*
            |--------------------------------------------------------------------------
            | Release Schedule
            |--------------------------------------------------------------------------
            */

            $booking->schedule()->update([
                'is_booked' => false,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Update Payment
            |--------------------------------------------------------------------------
            */

            if ($booking->payment) {

                $booking->payment->update([
                    'status' =>
                        PaymentStatusEnum::FAILED
                ]);
            }
        });

        return $booking->fresh([
            'user',
            'schedule.court.gor',
            'payment',
        ]);
    }

    public function complete(
        Booking $booking
    ): Booking {

        DB::transaction(function () use (
            $booking
        ) {

            $booking->update([
                'status' =>
                    BookingStatusEnum::COMPLETED
            ]);
        });

        return $booking->fresh([
            'user',
            'schedule.court.gor',
            'payment',
        ]);
    }
}