<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE bookings
            DROP CONSTRAINT bookings_status_check
        ");

        DB::statement("
            ALTER TABLE bookings
            ADD CONSTRAINT bookings_status_check
            CHECK (
                status IN (
                    'pending',
                    'paid',
                    'cancelled',
                    'expired'
                )
            )
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE bookings
            DROP CONSTRAINT bookings_status_check
        ");

        DB::statement("
            ALTER TABLE bookings
            ADD CONSTRAINT bookings_status_check
            CHECK (
                status IN (
                    'pending',
                    'paid',
                    'cancelled'
                )
            )
        ");
    }
};