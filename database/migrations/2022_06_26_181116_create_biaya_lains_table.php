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
        Schema::create('biaya_lains', function (Blueprint $table) {
            //id
            $table->id();
            $table->unsignedBigInteger('perjalanan_dinas_id')->nullable();
            //table isi
            $table->string('qty')->nullable();
            $table->string('jenis')->nullable();
            $table->string('biaya')->nullable();
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
        Schema::dropIfExists('biaya_lains');
    }
};
