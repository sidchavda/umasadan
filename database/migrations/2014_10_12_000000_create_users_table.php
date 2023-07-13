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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->default(''); 
            $table->string('middle_name')->default('');
            $table->string('last_name')->default('');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('mobile_number',15)->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female','transgender'])->nullable();
            $table->enum('marital_status', ['marride', 'unmarride'])->nullable();
            $table->rememberToken();
            $table->integer('otp')->nullable();
            $table->timestamp('otp_expiration')->nullable();
            $table->tinyInteger('activated')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
