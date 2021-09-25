<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitacorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedInteger('total_horas')->nullable();
            $table->text('observaciones_bitacora')->nullable();
            $table->binary('documento_pdf')->nullable();

            $table->unsignedBigInteger('estudiante_id')->nullable();
            $table->unsignedBigInteger('proyecto_social_id')->nullable();

            $table->timestamps();

            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onDelete('set null');
            $table->foreign('proyecto_social_id')->references('id')->on('proyectos_sociales')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bitacoras');
    }
}
