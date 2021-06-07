<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id('id');
            $table->string('carnet', 7);

            $table->unsignedBigInteger('carrera_id')->nullable();

            $table->unsignedInteger('materias_cursadas');
            $table->unsignedInteger('cantidad_horas_ss');
            $table->enum('estado', ['Inactivo', 'En espera', 'Realizando servicio', 'Servicio finalizado']);

            $table->unsignedBigInteger('persona_id')->nullable();

            $table->timestamps();

            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('set null');
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
}
