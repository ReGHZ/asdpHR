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
        Schema::create('rabs', function (Blueprint $table) {
            //id
            $table->id();
            $table->unsignedBigInteger('perjalanan_dinas_id')->nullable();
            $table->unsignedBigInteger('pengikut_id')->nullable();
            //tiket perjalanan dinas
            $table->string('maskapai')->nullable();
            $table->string('harga_tiket')->nullable();
            $table->string('tempat_berangkat')->nullable();
            $table->string('tempat_tujuan')->nullable();
            $table->string('charge')->nullable();
            $table->string('jumlah_harga_tiket')->nullable();
            //biaya harian
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
            $table->timestamps();
            //foreign key
            $table->foreign('perjalanan_dinas_id')->references('id')->on('perjalanan_dinas')->onDelete('cascade');
            $table->foreign('pengikut_id')->references('id')->on('pengikuts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rabs');
    }
};
