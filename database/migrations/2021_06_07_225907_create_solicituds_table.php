<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id('id');

            $table->unsignedBigInteger('estudiante_id')->nullable();
            $table->unsignedBigInteger('proyecto_social_id')->nullable();
            $table->date('fecha_solicitud');
            $table->text('justificacion_solicitud');
            $table->enum('estado_solicitud', ['En espera', 'Aceptado', 'Rechazado']);
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
        Schema::dropIfExists('solicituds');
    }
}
