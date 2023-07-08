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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->unsignedBigInteger('district_id');
            // $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            // $table->unsignedBigInteger('city_id');
            // $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->json('present_address')->nullable();
            $table->json('permanent_address')->nullable();
            $table->string('addhar_no',25)->nullable();
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
