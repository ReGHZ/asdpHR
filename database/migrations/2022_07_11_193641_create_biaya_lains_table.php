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
            $table->unsignedBigInteger('rab_id')->nullable();
            //biaya lain
            $table->string('qty',)->nullable();
            $table->string('jenis',)->nullable();
            $table->string('biaya_lain',)->nullable();
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
        Schema::dropIfExists('biaya_lains');
    }
};
