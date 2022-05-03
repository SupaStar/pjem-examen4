<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblusuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblusuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre', 100);
            $table->string('paterno', 100);
            $table->string('materno', 100);
            $table->string('login', 250);
            $table->string('password', 250);
            $table->integer('activo')->default(1);
            $table->unsignedBigInteger('cve_grupo');
            $table->foreign('cve_grupo')->references('cve_grupo_sistema')->on('tblgrupos_sistema');
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
        Schema::dropIfExists('tblusuarios');
    }
}
