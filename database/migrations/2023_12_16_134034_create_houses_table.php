<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->double('rent_fee')->nullable();
            $table->string('rent_fee_inclusion')->nullable();
            $table->unsignedInteger('installment_period')->nullable();
            $table->dateTime('available_on')->nullable();
            $table->unsignedInteger('number_of_rooms')->nullable();
            $table->unsignedInteger('number_of_views')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index('location_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
