<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstanciaCumplimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constancias_cumplimiento', function (Blueprint $table) {
            $table->id('id');

           //$table->unsignedBigInteger('proyecto_social_id')->nullable();
            $table->unsignedBigInteger('estudiante_id')->nullable();

            $table->timestamps();

           //$table->foreign('proyecto_social_id')->references('id')->on('proyectos_sociales')->onDelete('set null');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('constancia_cumplimientos');
    }
}
