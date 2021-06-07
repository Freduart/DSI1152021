<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('bitacora_id')->nullable();
            $table->string('nombre_actividad', 50);
            $table->date('fecha_actividad');
            $table->unsignedInteger('total_horas');
            $table->boolean('verificado');

            $table->timestamps();

            $table->foreign('bitacora_id')->references('id')->on('bitacoras')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividads');
    }
}
