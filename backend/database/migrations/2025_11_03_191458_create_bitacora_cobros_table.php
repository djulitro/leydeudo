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
        Schema::create('bitacora_cobros', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->bigInteger('id_contrato')->foreign()->references('id')->on('contratos');
            $table->integer('vendedor'); // TODO: Corresponde al usuario que crea la bitacora_cobros?
            $table->dateTime('fecha');
            $table->date('fecha_compromiso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacora_cobros');
    }
};
