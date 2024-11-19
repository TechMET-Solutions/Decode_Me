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
        Schema::create('student_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('studId');
            $table->foreign('studId')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('ex_id');
            $table->foreign('ex_id')->references('id')->on('experts')->onDelete('cascade');
            $table->unsignedBigInteger('dmsessionId');
            $table->foreign('dmsessionId')->references('id')->on('d_m_sessions')->onDelete('cascade');
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('mode')->nullable();
            $table->string('venue')->nullable();
            $table->longText('takeaway')->nullable();
            $table->longText('admintakeaway')->nullable();
            $table->string('stud_file')->nullable();
            $table->enum('status', ['0', '1', '2', '3'])->default('0')->nullable();
            $table->longText('remark')->nullable();
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
        Schema::dropIfExists('student_sessions');
    }
};
