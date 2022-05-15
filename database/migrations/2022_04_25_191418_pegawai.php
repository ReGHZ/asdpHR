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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personal_id')->nullable();
            $table->unsignedBigInteger('kantor_id')->nullable();
            $table->unsignedBigInteger('divisi_id')->nullable();
            $table->unsignedBigInteger('jabatan_id')->nullable();
            # Indexes
            $table->index('personal_id');
            $table->index('kantor_id');
            $table->index('divisi_id');
            $table->index('jabatan_id');
            $table->foreign('personal_id', 'personal_id_idx')->references('id')->on('personal')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kantor_id', 'kantor_id_idx')->references('id')->on('kantor')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('divisi_id', 'divisi_id_idx')->references('id')->on('divisi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jabatan_id', 'jabatan_id_idx')->references('id')->on('jabatan')->onDelete('cascade')->onUpdate('cascade');
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
