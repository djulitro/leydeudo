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
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_contrato')->foreign()->references('id')->on('contratos');
            $table->string('actividad', 1000);
            $table->bigInteger('id_responsable')->foreign()->references('id')->on('users'); // TODO: Esta bien esta relación?
            $table->dateTime('plazo', 0);
            $table->bigInteger('id_categoria');
            $table->string('descripcion', 2000);
            $table->integer('id_situacion'); // TODO: Existe tabla situaciones?
            $table->dateTime('fec_situacion', 0);
            $table->bigInteger('user_situacion')->foreign()->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividades');
    }
};
