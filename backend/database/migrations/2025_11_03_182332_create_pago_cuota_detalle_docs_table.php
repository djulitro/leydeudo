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
        Schema::create('pago_cuota_detalle_docs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_cuota')->foreign()->references('id')->on('pago_cuotas')->onDelete('cascade');
            $table->dateTime('fecha_pagado');
            $table->integer('id_formapago'); // TODO: Verificar si existe una tabla o hay que crearla para mostrar nombre/descripcion
            $table->integer('n_transaccion')->unique();
            $table->bigInteger('id_banco')->foreign()->references('id')->on('bancos')->onDelete('cascade');
            $table->string('archivo');
            $table->integer('monto');
            $table->integer('id_estado'); // TODO: Verificar si existe una tabla o hay que crearla para mostrar nombre/descripcion
            $table->bigInteger('id_usuario_aprueba')->foreign()->references('id')->on('users')->onDelete('cascade');
            $table->string('motivo'); // TODO: Verificar si existe una tabla o hay que crearla para mostrar nombre/descripcion
            $table->bigInteger('id_evento')->foreign()->references('id')->on('eventos')->onDelete('cascade');
            $table->string('pago_gerente'); // TODO: es un boolean?
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago_cuota_detalle_docs');
    }
};
