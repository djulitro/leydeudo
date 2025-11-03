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
        Schema::create('venta_consultas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_cliente')->foreign()->references('id')->on('clientes');
            $table->integer('monto');
            $table->integer('id_formapago'); // TODO: foreign a tabla formas_pago?
            $table->string('documento', 1000);
            $table->string('descripcion', 2000);
            $table->integer('vendedor'); // TODO: Corresponde al usuario que crea la venta_consulta?
            $table->integer('id_estado'); // TODO: Crear tabla estados_venta_consultas y foreign key?
            $table->dateTime('fecha');
            $table->bigInteger('id_usuario_aprueba')->foreign()->references('id')->on('usuarios');
            $table->dateTime('fecha_resolucion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_consultas');
    }
};
