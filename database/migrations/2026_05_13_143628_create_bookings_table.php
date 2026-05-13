<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignUuid('schedule_id')
                ->unique()
                ->constrained('schedules')
                ->cascadeOnDelete();
            $table->string('invoice_number')
                ->unique();
            $table->decimal(
                'total_price',
                12,
                2
            );
            $table->enum(
                'status',
                [
                    'pending',
                    'paid',
                    'cancelled',
                    'expired',
                ]
            )->default('pending');
            $table->timestamp('paid_at')
                ->nullable();
            $table->timestamp('expired_at')
                ->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};