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
        Schema::create('prospectos_medios', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 1000);
            $table->timestamps();
        });

        Schema::table('prospectos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_medio')->change();
            $table->foreign('id_medio')->references('id')->on('prospectos_medios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospectos_medios');
    }
};
