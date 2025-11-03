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
        Schema::create('pago_cuota_detalles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pago_cuotas')->foreign()->references('id')->on('pago_cuotas');
            $table->dateTime('fecha', 0);
            $table->integer('id_formapago');  // TODO: Verificar si existe una tabla formapago o hay que crearla para mostrar nombre/descripcion
            $table->integer('n_transaccion')->unique();
            $table->bigInteger('id_banco')->foreign()->references('id')->on('bancos');
            $table->string('archivo');
            $table->integer('monto');
            $table->integer('monto2');
            $table->integer('estado');
            $table->integer('id_tipo'); // TODO: Verificar si existe una tabla tipos o hay que crearla para mostrar nombre/descripcion
            $table->bigInteger('id_usuario_aprueba')->foreign()->references('id')->on('users');
            $table->dateTime('fecha_pagado', 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago_cuota_detalles');
    }
};
