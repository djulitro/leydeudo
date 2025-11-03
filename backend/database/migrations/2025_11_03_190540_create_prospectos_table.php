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
        // Esta tabla se ocupa realmente?
        Schema::create('prospectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->dateTime('fecha_registro');
            $table->string('correo');
            $table->integer('telefono');
            $table->integer('id_estado'); // TODO: Cambiar a foreign key cuando exista tabla estados
            $table->bigInteger('id_cliente')->foreign()->references('id')->on('clientes');
            $table->integer('id_interes');
            $table->integer('id_medio');
            $table->integer('vendedor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospectos');
    }
};
