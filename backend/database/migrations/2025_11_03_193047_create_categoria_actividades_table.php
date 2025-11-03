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
        Schema::create('categoria_actividades', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 1000);
            $table->timestamps();
        });

        Schema::table('actividades', function (Blueprint $table) {
            $table->unsignedBigInteger('id_categoria')->change();
            $table->foreign('id_categoria')->references('id')->on('categoria_actividades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_actividades');
    }
};
