<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->foreignUuid('booking_id')
                ->unique()
                ->constrained('bookings')
                ->cascadeOnDelete();

            $table->string('payment_gateway');

            $table->string('payment_reference')
                ->nullable();

            $table->decimal(
                'amount',
                12,
                2
            );

            $table->enum(
                'status',
                [
                    'pending',
                    'paid',
                    'failed',
                    'expired',
                ]
            )->default('pending');
            $table->json('payload')
                ->nullable();
            $table->timestamp('paid_at')
                ->nullable();
            $table->timestamp('expired_at')
                ->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};