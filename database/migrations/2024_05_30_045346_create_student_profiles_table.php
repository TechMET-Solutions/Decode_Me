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
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('studId');
            $table->foreign('studId')->references('id')->on('users')->onDelete('cascade');
            $table->string('studWant')->nullable();
            $table->string('fathWant')->nullable();
            $table->string('mothWant')->nullable();
            $table->longText('studDream')->nullable();
            $table->string('familyIncome')->nullable();
            $table->longText('outcome')->nullable();
            $table->longText('otherInfo')->nullable();
            $table->longText('doAcademic')->nullable();
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
        Schema::dropIfExists('student_profiles');
    }
};
