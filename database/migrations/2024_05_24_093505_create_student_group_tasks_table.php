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
        Schema::create('student_group_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('studId')->nullable();
            $table->unsignedBigInteger('taskID');
            $table->foreign('taskID')->references('id')->on('tasks')->onDelete('cascade');
            $table->longText('answer')->nullable();
            $table->string('task_file')->nullable();
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
        Schema::dropIfExists('student_group_tasks');
    }
};
