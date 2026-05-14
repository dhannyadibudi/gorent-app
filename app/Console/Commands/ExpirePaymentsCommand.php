<?php

namespace App\Console\Commands;

use App\Models\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExpirePaymentsCommand extends Command
{
    protected $signature =
        'payments:expire';

    protected $description =
        'Expire pending payments';

    public function handle(): void
    {
        $payments = Payment::query()
            ->with([
                'booking.schedule',
            ])
            ->where(
                'status',
                'pending'
            )
            ->where(
                'expired_at',
                '<=',
                now()
            )
            ->get();

        foreach ($payments as $payment) {

            DB::transaction(
                function () use ($payment) {

                    $payment->update([
                        'status' => 'expired',
                    ]);

                    $payment->booking
                        ->update([
                            'status' => 'expired',
                        ]);

                    $payment->booking
                        ->schedule
                        ->update([
                            'is_booked' => false,
                        ]);

                }
            );
        }

        $this->info(
            "{$payments->count()} payments expired."
        );
    }
}