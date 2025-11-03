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
        // TODO: Esta tabla es necesaria? se controlan las vistas de una tabla? es necesario para esta versión 2.0?
        Schema::create('vista_detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('id_vista');
            $table->string('descripcion');
            $table->integer('id_estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vista_detalles');
    }
};
