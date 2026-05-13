<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('court_id')
                ->constrained('courts')
                ->cascadeOnDelete();
            $table->date('schedule_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_booked')
                ->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->unique([
                'court_id',
                'schedule_date',
                'start_time',
                'end_time',
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};