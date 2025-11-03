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
        Schema::create('recupero_ddas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_contrato')->foreign()->references('id')->on('contratos');
            $table->integer('porcentaje');
            $table->integer('monto_ini');
            $table->integer('monto_fin');
            $table->dateTime('fecha_pago');
            $table->string('resultado');
            $table->integer('cuotas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recupero_ddas');
    }
};
