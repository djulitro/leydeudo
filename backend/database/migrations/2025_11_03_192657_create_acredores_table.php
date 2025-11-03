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
        Schema::create('acredores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_propuesta')->foreign()->references('id')->on('propuestas');
            $table->bigInteger('id_banco')->foreign()->references('id')->on('bancos');
            $table->integer('id_monto'); // TODO: Existe tabla montos?
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acredores');
    }
};
