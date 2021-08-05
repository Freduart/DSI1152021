<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncargadoFacultadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encargado_facultades', function (Blueprint $table) {
            $table->id('id');
            $table->string('codigo_encargado_facultad', 12);
            $table->string('nombre_encargado_facultad', 50);
            $table->string('apellido_encargado_facultad', 50);

            $table->unsignedBigInteger('user_id')->unique()->nullable();

            $table->string('dui_encargado_facultad', 10)->unique()->nullable();
            // $table->string('nit', 17);
            $table->string('telefono_encargado_facultad', 9)->unique()->nullable();
            $table->string('correo_encargado_facultad', 30)->unique();
            // $table->unsignedBigInteger('persona_id')->nullable();
            $table->unsignedBigInteger('facultad_id')->nullable();
            $table->enum('estado_encargado_facultad', ['Activo', 'Inactivo']);

            // $table->foreign('persona_id')->references('id')->on('personas')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('encargado_facultads');
    }
}
