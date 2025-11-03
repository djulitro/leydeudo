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
        Schema::create('pago_generales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_contrato')->foreign()->references('id')->on('contratos')->onDelete('cascade');
            $table->integer('dia_vencimiento');
            $table->dateTime('periodo_inicial');
            $table->integer('monto');
            $table->integer('cuotas');
            $table->integer('valor_cuota');
            $table->integer('id_formapago'); // TODO: Verificar si existe una tabla o hay que crearla para mostrar nombre/descripcion
            $table->integer('abono_inicial');
            $table->integer('id_estado'); // TODO: Verificar si existe una tabla o hay que crearla para mostrar nombre/descripcion
            $table->string('archivo');
            $table->integer('n_transaccion')->unique();
            $table->bigInteger('id_banco')->foreign()->references('id')->on('bancos')->onDelete('cascade');
            $table->integer('materia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago_generales');
    }
};
