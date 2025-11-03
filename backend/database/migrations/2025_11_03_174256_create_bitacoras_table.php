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
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_contrato')->foreign()->references('id')->on('contratos')->onDelete('cascade');
            $table->bigInteger('id_usuario')->foreign()->references('id')->on('users')->onDelete('cascade');
            $table->dateTime('fecha_hora');
            $table->string('descripcion');
            $table->string('archivo');
            $table->integer('tipo_bitacora');  // TODO: Verificar si existe una tabla tipos o hay que crearla para mostrar nombre/descripcion
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacoras');
    }
};
