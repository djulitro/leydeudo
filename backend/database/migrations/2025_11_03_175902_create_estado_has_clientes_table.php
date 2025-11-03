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
        Schema::create('estado_has_clientes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_cliente')->foreign()->references('id')->on('clientes')->onDelete('cascade');
            $table->bigInteger('id_usuario_activa')->foreign()->references('id')->on('users')->onDelete('cascade');
            $table->string('descripcion', 300);
            $table->bigInteger('id_estado')->foreign()->references('id')->on('estado_clientes')->onDelete('cascade');
            $table->dateTime('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_has_clientes');
    }
};
