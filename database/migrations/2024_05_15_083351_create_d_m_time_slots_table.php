<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('d_m_time_slots', function (Blueprint $table) {
            $table->id();
            $table->string('slot')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('d_m_time_slots');
    }
};
