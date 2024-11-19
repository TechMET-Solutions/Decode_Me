<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('taskID');
            $table->foreign('taskID')->references('id')->on('tasks')->onDelete('cascade');
            $table->unsignedBigInteger('studId');
            $table->foreign('studId')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('schoolId');
            $table->foreign('schoolId')->references('id')->on('school_details')->onDelete('cascade');
            $table->string('deadlineDate')->nullable();
            $table->string('deadlineTime')->nullable();
            $table->longText('desc')->nullable();
            $table->string('scheduleCall')->nullable();
            $table->enum('status', ['0', '1', '2', '3', '4'])->default('0');
            // $table->longText('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('individual_tasks');
    }
};
