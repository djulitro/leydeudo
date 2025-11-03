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
        // TODO: Esta tabla se utiliza realmente? permisos a nivel de detalle de vista?
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_detalle');
            $table->integer('id_usuario');
            $table->integer('id_estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos');
    }
};
