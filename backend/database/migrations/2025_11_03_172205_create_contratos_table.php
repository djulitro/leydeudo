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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_producto');
            $table->bigInteger('id_pagare');
            $table->bigInteger('id_user')->foreign()->references('id')->on('users');
            $table->integer('tipo_titular');
            $table->dateTime('fecha_contrato', 0);
            $table->dateTime('fecha_activacion', 0);
            $table->integer('id_cliente');
            $table->string('descripcion', 350);
            $table->integer('vigencia');
            $table->integer('id_estado');
            $table->date('fecha_gestion')->nullable();
            $table->date('fecha_compromiso')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
