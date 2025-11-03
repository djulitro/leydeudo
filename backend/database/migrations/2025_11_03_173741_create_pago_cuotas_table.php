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
        Schema::create('pago_cuotas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_contrato')->foreign()->references('id')->on('contratos')->onDelete('cascade');
            $table->integer('dia_vencimiento');
            $table->dateTime('periodo_inicial', 0);
            $table->integer('monto');
            $table->integer('cuotas');
            $table->integer('valor_cuota');
            $table->integer('forma_pago');
            $table->integer('abono_inicial');
            $table->integer('id_estado'); // validar que tipos de estados ocupa para agregar tabla correspondiente.
            $table->string('archivo');
            $table->integer('n_transaccion');
            $table->bigInteger('id_banco')->foreign()->references('id')->on('bancos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago_cuotas');
    }
};
