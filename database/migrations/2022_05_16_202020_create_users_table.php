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
        Schema::create('users', function (Blueprint $table) {
            //id
            $table->id();
            $table->unsignedBigInteger('divisi_id')->nullable();
            $table->unsignedBigInteger('jabatan_id')->nullable();
            //original user table fields
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            //employee table fields
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('usia')->nullable()->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->date('tanggal_masuk_kerja')->nullable();
            $table->String('masa_kerja')->nullable()->nullable();
            $table->date('tanggal_pilih_jabatan')->nullable();
            $table->string('masa_jabatan')->nullable();
            $table->timestamps();
            # Indexes
            $table->index('divisi_id');
            $table->index('jabatan_id');
            //foreign key
            $table->foreign('divisi_id', 'divisi_id_idx')->references('id')->on('divisis');
            $table->foreign('jabatan_id', 'jabatan_id_idx')->references('id')->on('jabatans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
