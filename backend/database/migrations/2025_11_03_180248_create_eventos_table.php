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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pago_cuotas')->foreign()->references('id')->on('pago_cuotas')->onDelete('cascade');
            $table->integer('id_tipo_pago'); // TODO: Verificar si existe una tabla tipo o hay que crearla para mostrar nombre/descripcion
            $table->bigInteger('id_campana')->nullable(); // TODO: Verificar si existe una tabla campana o hay que crearla para mostrar nombre/descripcion
            $table->integer('desc_campana')->nullable();
            $table->integer('monto');
            $table->dateTime('fecha_pagado')->nullable();
            $table->integer('id_formapago'); // TODO: Verificar si existe una tabla formapago o hay que crearla para mostrar nombre/descripcion
            $table->integer('n_transaccion')->unique();
            $table->bigInteger('id_banco')->foreign()->references('id')->on('bancos')->onDelete('cascade');
            $table->string('archivo');
            $table->integer('id_estado'); // TODO: Verificar si existe una tabla estado o hay que crearla para mostrar nombre/descripcion
            $table->bigInteger('id_usuario_aprueba')->foreign()->references('id')->on('users')->onDelete('cascade');
            $table->dateTime('fecha_aprobado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
