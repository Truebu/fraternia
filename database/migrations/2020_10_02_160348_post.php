<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Post extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacion', function (Blueprint $table) {
            $table->id('publicacionId')->autoIncrement();
            $table->string('publicacionTitulo', 250);
            $table->string('pubpublicacionDescripcion', 250);
            $table->integer('fk_tipoPublicacionId');
            $table->integer('fk_usuarioId');
            $table->date('publicacionFechaCreacion');
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
        Schema::dropIfExists('publicacion');
    }
}
