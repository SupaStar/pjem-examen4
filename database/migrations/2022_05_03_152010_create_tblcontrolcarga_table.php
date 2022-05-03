<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblcontrolcargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblcontrolcarga', function (Blueprint $table) {
            $table->id('id_Control_Carga');
            $table->unsignedBigInteger('id_Usuario');
            $table->integer('anio');
            $table->integer('total');
            $table->foreign('id_Usuario')->references('id_usuario')->on('tblusuarios');
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
        Schema::dropIfExists('tblcontrolcarga');
    }
}
