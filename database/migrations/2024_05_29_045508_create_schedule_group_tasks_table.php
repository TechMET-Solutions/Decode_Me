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
        Schema::create('schedule_group_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('studId');
            $table->foreign('studId')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('taskID');
            $table->foreign('taskID')->references('id')->on('tasks')->onDelete('cascade');
            $table->unsignedBigInteger('schoolId');
            $table->foreign('schoolId')->references('id')->on('school_details')->onDelete('cascade');
            $table->unsignedBigInteger('grpTaskId');
            $table->foreign('grpTaskId')->references('id')->on('group_tasks')->onDelete('cascade');
            $table->string('scheduleDate')->nullable();
            $table->string('scheduleTime')->nullable();
            $table->enum('status', ['0', '1'])->default('0')->nullable();
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
        Schema::dropIfExists('schedule_group_tasks');
    }
};
