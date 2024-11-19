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
        Schema::create('workshop_dates', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('venue')->nullable();
            $table->string('seats')->nullable();
            $table->string('expert')->nullable();
            $table->longText('desc')->nullable();
            $table->unsignedBigInteger('workshop_id');
            $table->foreign('workshop_id')->references('id')->on('workshops')->onDelete('cascade');
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
        Schema::dropIfExists('workshop_dates');
    }
};
