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
        Schema::create('career_clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('link')->nullable();
            $table->string('leader_name')->nullable();
            $table->unsignedBigInteger('sch_id');
            $table->foreign('sch_id')->references('id')->on('school_details')->onDelete('cascade');
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
        Schema::dropIfExists('career_clubs');
    }
};
