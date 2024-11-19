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
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('topic')->nullable();
            $table->string('start_date')->nullable();
            $table->string('start_time_start_date')->nullable();
            $table->string('end_time_start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('start_time_end_date')->nullable();
            $table->string('end_time_end_date')->nullable();
            $table->string('venue')->nullable();
            $table->string('seats')->nullable();
            $table->enum('status', ['0', '1', '2'])->default('0');
            $table->string('expert')->nullable();
            $table->longText('desc')->nullable();
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
        Schema::dropIfExists('workshops');
    }
};
