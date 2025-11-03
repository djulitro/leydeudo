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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->integer('id_estado');
            $table->string('id_tipo_contrato');  // TODO: Verificar si existe una tabla tipos o hay que crearla para mostrar nombre/descripcion
            $table->timestamps();
        });

        Schema::table('contratos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_producto')->change();
            $table->foreign('id_producto')->references('id')->on('productos');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropForeign(['id_producto']);
            $table->bigInteger('id_producto')->change();
        });

        Schema::dropIfExists('productos');
    }
};
