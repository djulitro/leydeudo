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
        Schema::create('estado_contratos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_estado');
            $table->string('descripcion');
            $table->timestamps();
        });

        Schema::table('contratos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_estado')->change();
            $table->foreign('id_estado')->references('id')->on('estado_contratos');
        });

    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropForeign(['id_estado']);
            $table->bigInteger('id_estado')->change();
        });

        Schema::dropIfExists('estado_contratos');
    }
};
