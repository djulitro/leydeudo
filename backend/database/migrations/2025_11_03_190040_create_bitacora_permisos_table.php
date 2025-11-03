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
        // TODO: Realmente se utiliza esta tabla? lo mismo con permisos.
        Schema::create('bitacora_permisos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user_conectado');
            $table->integer('id_user_permiso');
            $table->integer('id_atributo');
            $table->dateTime('fecha_asignacion', 0);
            $table->integer('permiso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacora_permisos');
    }
};
