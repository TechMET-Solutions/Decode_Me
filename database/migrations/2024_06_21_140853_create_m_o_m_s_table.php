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
        Schema::create('m_o_m_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cc_id');
            $table->foreign('cc_id')->references('id')->on('career_clubs')->onDelete('cascade');
            $table->unsignedBigInteger('studId');
            $table->foreign('studId')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('schoolId');
            $table->foreign('schoolId')->references('id')->on('school_details')->onDelete('cascade');
            $table->longText('mom')->nullable();
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
        Schema::dropIfExists('m_o_m_s');
    }
};
