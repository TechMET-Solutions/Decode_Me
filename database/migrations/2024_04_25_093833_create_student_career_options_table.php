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
        Schema::create('student_career_options', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->unsignedBigInteger('stud_id');
            $table->foreign('stud_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('sc_priority')->nullable();
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
        Schema::dropIfExists('student_career_options');
    }
};
