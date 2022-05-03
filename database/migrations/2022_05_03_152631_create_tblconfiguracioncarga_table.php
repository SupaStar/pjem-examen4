<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblconfiguracioncargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblconfiguracioncarga', function (Blueprint $table) {
            $table->id('id_Configuracion_Carga');
            $table->integer('proporcion');
            $table->integer('diferencia');
            $table->integer('anio');
            $table->integer('activo')->default(1);
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
        Schema::dropIfExists('tblconfiguracioncarga');
    }
}
