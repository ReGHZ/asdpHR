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
        Schema::create('realisasi_b_lains', function (Blueprint $table) {
            //id
            $table->id();
            $table->unsignedBigInteger('realisasi_id')->nullable();
            //biaya lain
            $table->string('qty',)->nullable();
            $table->string('jenis',)->nullable();
            $table->string('biaya',)->nullable();
            $table->timestamps();
            //foreign key
            $table->foreign('realisasi_id')->references('id')->on('realisasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realisasi_b_lains');
    }
};
