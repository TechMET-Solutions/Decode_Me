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
        Schema::create('intern_takeaways', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intern_id');
            $table->foreign('intern_id')->references('id')->on('internships')->onDelete('cascade');
            $table->unsignedBigInteger('stud_id');
            $table->foreign('stud_id')->references('id')->on('users')->onDelete('cascade');
            $table->longText('desc')->nullable();
            $table->string('file')->nullable();
            $table->enum('status', ['0', '1'])->default('0');
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
        Schema::dropIfExists('intern_takeaways');
    }
};
