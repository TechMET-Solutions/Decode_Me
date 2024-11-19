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
        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('qualification')->nullable();
            $table->string('occupation')->nullable();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('expertise')->nullable();
            $table->string('bank_account_holder_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('date_of_join')->nullable();
            $table->string('date_of_resignation')->nullable();
            $table->string('aadhar_card')->nullable();
            $table->string('pan_card')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('experts');
    }
};
