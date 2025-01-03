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
        Schema::create('consults', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('designer_id');
            $table->foreign('designer_id')->references('id')->on('interior_designers');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->date('booking_date');
            $table->time('booking_time');
            $table->string('brief');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consults');
    }
};
