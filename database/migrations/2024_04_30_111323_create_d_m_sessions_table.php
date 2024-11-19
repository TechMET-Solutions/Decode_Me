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
        Schema::create('d_m_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ex_id');
            $table->foreign('ex_id')->references('id')->on('experts')->onDelete('cascade');
            $table->string('date')->nullable();
            $table->longText('time')->nullable();
            $table->string('mode')->nullable();
            $table->string('venue')->nullable();
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
        Schema::dropIfExists('d_m_sessions');
    }
};
