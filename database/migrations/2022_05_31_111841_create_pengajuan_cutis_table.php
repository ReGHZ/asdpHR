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
        Schema::create('pengajuan_cutis', function (Blueprint $table) {
            //id
            $table->id();
            $table->unsignedBigInteger('usercuti_id')->nullable();
            //table isi
            $table->string('nomor_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->integer('lama_hari')->nullable();
            $table->enum(
                'jenis_cuti',
                [
                    'Cuti tahunan',
                    'Cuti sakit',
                    'Cuti bersalin',
                    'Cuti besar'
                ]
            )->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            # Indexes
            $table->index('usercuti_id');
            //foreign key
            $table->foreign('usercuti_id', 'usercuti_id_idx')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_cutis');
    }
};
