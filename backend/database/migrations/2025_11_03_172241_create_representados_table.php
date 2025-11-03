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
        Schema::create('representados', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_contrato')->foreign()->references('id')->on('contratos');
            $table->string('nombre');
            $table->string('rut');
            $table->string('correo');
            $table->string('celular');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representados');
    }
};
