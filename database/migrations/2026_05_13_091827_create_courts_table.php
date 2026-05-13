<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courts', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->foreignUuid('gor_id')
                ->constrained('gors')
                ->cascadeOnDelete();

            $table->string('name');

            $table->decimal(
                'price_per_hour',
                12,
                2
            );

            $table->time('open_time');

            $table->time('close_time');

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->softDeletes();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};