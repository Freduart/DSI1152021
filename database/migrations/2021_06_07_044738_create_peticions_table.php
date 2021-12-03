<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeticionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peticiones', function (Blueprint $table) {
            $table->id('id')->nullable();
            $table->unsignedInteger('cantidad_estudiantes');
            $table->string('nombre_peticion', 60);
            $table->text('descripcion_peticion');
            $table->string('ubicacion_actividades', 50);
            $table->date('fecha_peticion')->nullable();
            $table->date('fecha_peticion_fin')->nullable();
            $table->unsignedBigInteger('cantidad_horas');
            $table->string('otros_tipo_servicio')->nullable();
            $table->enum('estado_peticion', ['En espera', 'Aceptado', 'Rechazado']);
            $table->string('correo_peticion', 50);

            $table->unsignedBigInteger('carrera_id')->nullable();
            $table->unsignedBigInteger('tipo_servicio_social_id')->nullable();
            $table->unsignedBigInteger('institucion_id')->nullable();

            $table->timestamps();


            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('set null');
            $table->foreign('tipo_servicio_social_id')->references('id')->on('tipos_servicio_social')->onDelete('set null');
            $table->foreign('institucion_id')->references('id')->on('instituciones')->onDelete('set null');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peticions');
    }
}
