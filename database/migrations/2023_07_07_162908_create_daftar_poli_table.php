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
        Schema::create('daftar_poli', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_pasien");
            $table->foreign("id_pasien")->references("id")->on("pasien")->onDelete("cascade");
            $table->foreignId("id_jadwal");
            $table->foreign("id_jadwal")->references("id")->on("jadwal_periksa")->onDelete("cascade");
            $table->text("keluhan");
            $table->unsignedInteger("no_antrian");
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
        Schema::dropIfExists('daftar_poli');
    }
};
