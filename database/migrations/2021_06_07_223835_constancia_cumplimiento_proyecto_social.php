<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConstanciaCumplimientoProyectoSocial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constancia_c_proyecto_s', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('constancia_cumplimiento_id')->nullable();
            $table->unsignedBigInteger('proyecto_social_id')->nullable();

            $table->timestamps();

            $table->foreign('constancia_cumplimiento_id')->references('id')->on('constancias_cumplimiento')->onDelete('set null');
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
        //
    }
}
