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
        Schema::create('business_request_details', function (Blueprint $table) {
            $table->id();  
            $table->unsignedBigInteger('b_r_id');
            $table->foreign('b_r_id')->references('id')->on('business_requests')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('degree_id')->nullable();
            $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('cascade');
            $table->json('sub_degree_id')->nullable();  
            $table->integer('experience_year')->nullable();
            $table->string('section',200)->nullable(); 
            $table->enum('delivery_type',['home','pickup'])->nullable();
            $table->enum('job_day_type',['fulltime','parttime'])->nullable(); 
            $table->enum('shift',['day','night'])->nullable(); 
            $table->enum('work_platform',['home','office'])->nullable(); 
            $table->integer('working_hours')->nullable();
            $table->text('business_desc')->nullable(); 
            $table->json('products')->nullable();   
            $table->text('id_proof')->nullable();      
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_request_details');
    }
};
