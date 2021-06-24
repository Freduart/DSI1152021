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
            $table->string('nombre_estudiante', 50);
            $table->string('apellido_estudiante', 50);
            $table->unsignedBigInteger('user_id')->nullable()->unique();
            $table->string('carnet_estudiante', 7)->unique();
            $table->enum('sexo_estudiante', ['Masculino', 'Femenino']);
            $table->string('correo_estudiante', 30)->unique();
            $table->string('telefono_estudiante', 9)->unique();
            $table->unsignedBigInteger('carrera_id')->nullable();
            $table->string('dui_estudiante', 10)->nullable()->unique();
            $table->string('nit_estudiante', 17)->nullable()->unique();
            $table->unsignedInteger('materias_cursadas');
            $table->unsignedBigInteger('porcentaje_aprobacion');
            $table->unsignedInteger('cantidad_horas_ss');
            $table->enum('estado_estudiante', ['Inactivo','Activo','En espera', 'Realizando servicio', 'Servicio finalizado']);

            // $table->unsignedBigInteger('persona_id')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('set null');
            // $table->foreign('persona_id')->references('id')->on('personas')->onDelete('set null');
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
