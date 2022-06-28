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
        Schema::create('tiket_perjalanans', function (Blueprint $table) {
            //id
            $table->id();
            $table->unsignedBigInteger('perjalanan_dinas_id')->nullable();
            //table isi
            $table->string('maskapai')->nullable();
            $table->string('harga_tiket')->nullable();
            $table->string('tempat_berangkat')->nullable();
            $table->string('tempat_tujuan')->nullable();
            $table->string('charge')->nullable();
            $table->string('jumlah')->nullable();
            $table->timestamps();
            //foreign key
            $table->foreign('perjalanan_dinas_id')->references('id')->on('perjalanan_dinas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiket_perjalanans');
    }
};
