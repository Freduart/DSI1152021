<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncargadoEscuelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encargado_escuelas', function (Blueprint $table) {
            $table->id('id');

            $table->unsignedBigInteger('persona_id')->nullable();
            $table->unsignedBigInteger('carrera_id')->nullable();

            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('set null');
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encargado_escuelas');
    }
}
