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
        // TODO: Realmente se utiliza esta tabla?
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha', 0);
            $table->bigInteger('id_cliente')->foreign()->references('id')->on('clientes')->onDelete('cascade');
            $table->integer('id_estado');  // TODO: Verificar si existe una tabla estado o hay que crearla para mostrar nombre/descripcion
            $table->string('patente');
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
        Schema::dropIfExists('vehiculos');
    }
};
