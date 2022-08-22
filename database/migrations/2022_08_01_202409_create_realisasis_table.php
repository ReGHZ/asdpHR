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
        Schema::create('realisasis', function (Blueprint $table) {
            //id
            $table->id();
            $table->unsignedBigInteger('rab_id')->nullable();
            //tiket perjalanan dinas
            $table->string('maskapai')->nullable();
            $table->string('harga_tiket')->nullable();
            $table->string('tempat_berangkat')->nullable();
            $table->string('tempat_tujuan')->nullable();
            $table->string('charge')->nullable();
            $table->string('jumlah_harga_tiket')->nullable();
            //biaya harian
            $table->string('lama_hari')->nullable();
            $table->string('biaya_harian')->nullable();
            $table->string('jumlah_biaya_harian')->nullable();
            //biaya penginapan
            $table->string('lama_hari_penginap')->nullable();
            $table->string('biaya_penginapan')->nullable();
            $table->string('jumlah_biaya_penginapan')->nullable();
            //total
            $table->string('total')->nullable();
            //biaya lain
            $table->string('jumlah_biaya_lain')->nullable();
            //kas
            $table->string('biaya_kas')->nullable();
            $table->string('biaya_ybs')->nullable();
            $table->string('uang_muka')->nullable();
            $table->date('tanggal_uang_muka')->nullable();
            $table->timestamps();
            //foreign key
            $table->foreign('rab_id')->references('id')->on('rabs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realisasis');
    }
};
