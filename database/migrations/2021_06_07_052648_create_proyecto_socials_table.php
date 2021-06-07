<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos_sociales', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('peticion_id')->unique()->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('numero_horas');
            $table->enum('estado', ['No iniciado', 'En curso', 'Finalizado', 'Cancelado']);
            $table->timestamps();

            $table->foreign('peticion_id')->references('id')->on('peticiones')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto_socials');
    }
}
