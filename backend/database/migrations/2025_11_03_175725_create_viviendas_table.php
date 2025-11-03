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
        Schema::create('viviendas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_cliente')->foreign()->references('id')->on('clientes')->onDelete('cascade');
            $table->integer('id_estado');  // TODO: Verificar si existe una tabla estado o hay que crearla para mostrar nombre/descripcion
            $table->string('rol');
            $table->integer('id_situacion');  // TODO: Verificar si existe una tabla situacion o hay que crearla para mostrar nombre/descripcion
            $table->string('acreedor');
            $table->integer('vigencia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viviendas');
    }
};
