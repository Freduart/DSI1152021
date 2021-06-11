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

            // $table->unsignedBigInteger('persona_id')->nullable();
            $table->unsignedBigInteger('carrera_id')->nullable();

            $table->string('nombre_encargado_escuela', 50);
            $table->string('apellido_encargado_escuela', 50);

            $table->unsignedBigInteger('user_id')->unique()->nullable();

            $table->string('dui_encargado_escuela', 10)->unique()->nullable();
            // $table->string('nit', 17);
            $table->string('telefono_encargado_escuela', 9)->unique()->nullable();

            // $table->unsignedBigInteger('persona_id')->nullable();
            // $table->unsignedBigInteger('facultad_id')->nullable();
            $table->boolean('estado_encargado_escuela');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            
            $table->timestamps();
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
