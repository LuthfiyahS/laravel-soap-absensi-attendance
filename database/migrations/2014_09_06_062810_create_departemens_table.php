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
        Schema::create('departemens', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_masuk_mulai')->nullable();
            $table->time('jam_masuk_selesai')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->time('jam_pulang_mulai')->nullable();
            $table->time('jam_pulang_selesai')->nullable();
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
        Schema::dropIfExists('departemens');
    }
};
