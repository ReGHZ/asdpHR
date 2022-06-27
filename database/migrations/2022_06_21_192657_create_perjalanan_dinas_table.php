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
        Schema::create('perjalanan_dinas', function (Blueprint $table) {
            //id
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('pengikut')->nullable();
            //table isi
            $table->string('nomor_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->string('perihal')->nullable();
            $table->string('pembebanan_biaya')->nullable();
            $table->date('tanggal_keberangkatan')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->string('lama_hari')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('jenis_kendaraan')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('biaya_kas')->nullable();
            $table->string('biaya_ybs')->nullable();
            $table->string('disetujui_di')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            //foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pengikut')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perjalanan_dinas');
    }
};
