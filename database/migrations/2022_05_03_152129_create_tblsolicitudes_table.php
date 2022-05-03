<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblsolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblsolicitudes', function (Blueprint $table) {
            $table->id('id_solicitud');
            $table->unsignedBigInteger('id_Usuario_Asignado');
            $table->string('nombre_Solicitante', 100);
            $table->string('paterno_Solicitante', 100);
            $table->string('materno_Solicitante', 100);
            $table->integer('activo')->default(1);
            $table->dateTime('fecha_Solicitud');
            $table->foreign('id_Usuario_Asignado')->references('id_usuario')->on('tblusuarios');
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
        Schema::dropIfExists('tblsolicitudes');
    }
}
