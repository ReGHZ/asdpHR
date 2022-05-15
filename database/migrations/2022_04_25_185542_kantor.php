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
        Schema::create('kantor', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->nullable();
            $table->date('tanggal_masuk_kerja')->nullable();
            $table->text('masa_kerja')->nullable();
            $table->date('tanggal_pilih_jabatan')->nullable();
            $table->string('masa_jabatan')->nullable();
            $table->string('darat_laut_lokasi')->nullable();
            $table->string('sk')->nullable();
            $table->string('gol_skala_tht')->nullable();
            $table->string('skala_tht')->nullable();
            $table->string('gol_phdp')->nullable();
            $table->string('gol_skala_phdp')->nullable();
            $table->string('gol_gaji')->nullable();
            $table->string('gol_skala_gaji')->nullable();
            $table->string('pangkat')->nullable();
            # Indexes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
