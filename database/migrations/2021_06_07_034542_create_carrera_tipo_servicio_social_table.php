<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarreraTipoServicioSocialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrera_tipo_servicio_social', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carrera_id')->nullable();
            $table->unsignedBigInteger('tipo_servicio_social_id')->nullable();
            
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('set null');
            $table->foreign('tipo_servicio_social_id')->references('id')->on('tipos_servicio_social')->onDelete('set null');

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
        Schema::dropIfExists('carrera_tipo_servicio_social');
    }
}
