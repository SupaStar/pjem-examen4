<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblbitacorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblbitacoras', function (Blueprint $table) {
            $table->id('id-Bitacora');
            $table->unsignedBigInteger('id_Usuario');
            $table->unsignedBigInteger('cve_Accion');
            $table->dateTime('fecha');
            $table->mediumText('movimiento');
            $table->foreign('id_Usuario')->references('id_Usuario')->on('tblusuarios');
            $table->foreign('cve_Accion')->references('cve_Accion')->on('tblacciones');
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
        Schema::dropIfExists('tblbitacoras');
    }
}
