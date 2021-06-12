<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre_carrera', 50)->unique();
            $table->string('codigo_carrera', 7)->unique();
            $table->unsignedBigInteger('facultad_id')->nullable();
            $table->enum('estado_carrera', ['Activo', 'Inactivo']);

            $table->foreign('facultad_id')->references('id')->on('facultades')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carreras');
    }
}
