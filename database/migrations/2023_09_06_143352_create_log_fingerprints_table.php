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
        Schema::create('log_fingerprints', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('user_id');
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->datetime('datetime');
            $table->foreignId('mesin_id')->references('id')->on('mesin_fingerprints')->onUpdate('cascade')->onDelete('cascade');
            $table->string('status');
            $table->foreignId('sync_id')->references('id')->on('sync_fingerprints')->onUpdate('cascade')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('log_fingerprints');
    }
};
