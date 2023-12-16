<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    /**
     * id	locationId	postedUserId	rentFee	rentFeeInclusion	installmentPeriod	availableOn	numberOfBedrooms	numberOfViews	description
     */
    public function up(): void
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->double('rent_fee')->nullable();
            $table->string('rent_fee_inclusion')->nullable();
            $table->unsignedInteger('installment_period')->nullable();
            $table->date('available_on')->nullable();
            $table->unsignedInteger('number_of_rooms')->nullable();
            $table->unsignedInteger('number_of_views')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
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
