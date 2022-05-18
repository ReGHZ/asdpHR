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
        Schema::create('pegawais', function (Blueprint $table) {
            //id
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('divisi_id')->nullable();
            $table->unsignedBigInteger('jabatan_id')->nullable();
            //table isi
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('usia')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->date('tanggal_masuk_kerja')->nullable();
            $table->String('masa_kerja')->nullable();
            $table->date('tanggal_pilih_jabatan')->nullable();
            $table->string('masa_jabatan')->nullable();
            $table->timestamps();
            # Indexes
            $table->index('divisi_id');
            $table->index('jabatan_id');
            $table->index('user_id');
            //foreign key
            $table->foreign('divisi_id', 'divisi_id_idx')->references('id')->on('divisis');
            $table->foreign('jabatan_id', 'jabatan_id_idx')->references('id')->on('jabatans');
            $table->foreign('user_id', 'user_id_idx')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
};
