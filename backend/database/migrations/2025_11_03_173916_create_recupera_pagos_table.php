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
        Schema::create('recupera_pagos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_recupero')->foreign()->references('id')->on('recuperos')->onDelete('cascade');
            $table->dateTime('fecha');
            $table->integer('id_formapago'); // TODO: Si existe tabla formaPago agregar la foreign key mas adelante.
            $table->integer('n_transaccion')->unique();
            $table->bigInteger('id_banco')->foreign()->references('id')->on('bancos')->onDelete('cascade');
            $table->string('archivo');
            $table->integer('monto');
            $table->integer('estado');
            $table->integer('id_tipo');  // TODO: Verificar si existe una tabla tipos o hay que crearla para mostrar nombre/descripcion
            $table->bigInteger('id_usuario_aprueba')->foreign()->references('id')->on('usuarios')->onDelete('cascade');
            $table->dateTime('fecha_pago', 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recupera_pagos');
    }
};
