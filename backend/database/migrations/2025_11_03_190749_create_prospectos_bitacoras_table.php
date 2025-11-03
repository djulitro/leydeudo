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
        Schema::create('prospectos_bitacoras', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->bigInteger('id_prospecto')->foreign()->references('id')->on('prospectos');
            $table->integer('vendedor');
            $table->dateTime('fecha');
            $table->integer('reagendado');
            $table->dateTime('fecha_reagendacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospectos_bitacoras');
    }
};
