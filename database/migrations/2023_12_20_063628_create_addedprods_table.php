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
        Schema::create('addedprods', function (Blueprint $table) {
            $table->id();
            $table->string('Product_Name');
            $table->integer('Product_Price');
            $table->integer('Product_Quantity');
            $table->integer('Product_Total');
            $table->integer('User_Id');
            $table->foreign('User_Id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addedprods');
    }
};
