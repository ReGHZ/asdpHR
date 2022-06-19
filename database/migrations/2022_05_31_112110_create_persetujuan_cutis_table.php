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
        Schema::create('persetujuan_cutis', function (Blueprint $table) {
            //id
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pengajuan_cuti_id')->nullable();
            //table isi
            $table->string('nomor_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
            # Indexes
            $table->index('pengajuan_cuti_id');
            //foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pengajuan_cuti_id', 'pengajuan_cuti_id_idx')->references('id')->on('pengajuan_cutis')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persetujuan_cutis');
    }
};
