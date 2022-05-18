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
        Schema::create('personals', function (Blueprint $table) {
            //id
            $table->id();
            $table->unsignedBigInteger('pegawai_id')->nullable();
            //table isi
            $table->string('status_keluarga')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('nik_ktp')->nullable();
            $table->string('no_bpjs_kesehatan')->nullable();
            $table->string('no_bpjs_ketenagakerjaan')->nullable();
            $table->string('npwp')->nullable();
            $table->string('no_inhealth')->nullable();
            $table->string('no_rek')->nullable();
            $table->string('ukuran_sepatu')->nullable();
            $table->string('ukuran_baju')->nullable();
            $table->string('darat_laut_lokasi')->nullable();
            $table->string('sk')->nullable();
            $table->string('gol_skala_tht')->nullable();
            $table->string('skala_tht')->nullable();
            $table->string('gol_phdp')->nullable();
            $table->string('gol_skala_phdp')->nullable();
            $table->string('gol_gaji')->nullable();
            $table->string('gol_skala_gaji')->nullable();
            $table->string('segmen')->nullable();
            $table->timestamps();
            # Indexes
            $table->index('pegawai_id');
            //foreign key
            $table->foreign('pegawai_id', 'pegawai_id_idx')->references('id')->on('pegawais')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personals');
    }
};
