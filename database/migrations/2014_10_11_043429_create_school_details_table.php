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
        Schema::create('school_details', function (Blueprint $table) {
            $table->id();
            $table->string('school_name')->nullable();
            $table->string('school_code')->nullable();
            $table->string('school_contact')->nullable();
            $table->string('school_email')->nullable();
            $table->string('school_place')->nullable();
            $table->enum('status', [0, 1])->default(0);
            $table->string('concern_person_name')->nullable();
            $table->string('concern_person_phone')->nullable();
            $table->string('alt_contact_person_name')->nullable();
            $table->string('alt_contact_person_phone')->nullable();
            $table->string('date_of_join')->nullable();
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
        Schema::dropIfExists('school_details');
    }
};
