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
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile')->nullable();
            $table->string('role')->default('user');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('profile')->nullable();
            $table->string('dob')->nullable();
            $table->string('aadhaar')->nullable();
            $table->string('pan')->nullable();
            $table->string('enrollDate')->nullable();
            $table->string('bank_holder_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_acc_no')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();
            $table->foreign('school_id')->references('id')->on('school_details')->onDelete('cascade');
            $table->string('std')->nullable();
            $table->string('expert')->nullable();
            $table->enum('current_status', ['workshop', 'session', 'task', 'career_club_activity', 'internship'])->default('workshop');
            $table->string('motherName')->nullable();
            $table->string('motherPhone')->nullable();
            $table->string('motherOccupation')->nullable();
            $table->string('fatherName')->nullable();
            $table->string('fatherPhone')->nullable();
            $table->string('fatherOccupation')->nullable();
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
