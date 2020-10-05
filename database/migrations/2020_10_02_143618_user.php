<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('usuarioNombre', 200);
            $table->string('usuarioEmail', 200)->unique();
            $table->string('usuarioTelefonoPrincipal');
            $table->string('usuarioContraseña', 250);
            $table->foreignId('fk_universidadId');
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
        Schema::dropIfExists('usuario');
    }
}
