<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('rut');
            $table->integer('telefono');
            $table->string('celular');
            $table->string('correo');
            $table->string('direccion');
            $table->bigInteger('id_comuna')->foreign()->references('id')->on('comunas');
            $table->bigInteger('id_nacionalidad')->foreign()->references('id')->on('nacionalidades');
            $table->dateTime('fecha_hora', 0);
            $table->integer('id_confirmacion');
            $table->string('clave');
            $table->integer('id_ecivil');
            $table->integer('id_regimen');
            $table->integer('id_estado');
            $table->integer('client_validate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
