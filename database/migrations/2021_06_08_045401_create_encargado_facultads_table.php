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

            $table->unsignedBigInteger('persona_id')->nullable();
            $table->unsignedBigInteger('facultad_id')->nullable();

            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('set null');
            $table->foreign('facultad_id')->references('id')->on('facultades')->onDelete('set null');
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
