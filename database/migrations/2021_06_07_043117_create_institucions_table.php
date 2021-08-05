<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituciones', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre_institucion', 30);
            $table->string('contacto_institucion', 50);
            $table->string('correo_institucion', 50)->unique();
            $table->string('telefono_institucion', 9)->unique();
            $table->string('ubicacion_institucion', 150);
            $table->string('rubro_institucion', 100);
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
        Schema::dropIfExists('institucions');
    }
}
