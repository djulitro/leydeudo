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
        Schema::create('campanas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->dateTime('fecha');
            $table->dateTime('fecha_inicial');
            $table->dateTime('fecha_termino');
            $table->integer('p_descto1');
            $table->integer('p_pago1');
            $table->integer('p_descto2');
            $table->integer('p_pago2');
            $table->bigInteger('id_creador')->foreign()->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_estado'); // TODO: Verificar si existe una tabla o hay que crearla para mostrar nombre/descripcion
            $table->timestamps();
        });

        Schema::table('eventos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_campana')->nullable()->change();
            $table->foreign('id_campana')->references('id')->on('campanas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campanas');
    }
};
