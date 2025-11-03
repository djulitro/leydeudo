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
        Schema::create('pagares', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->timestamps();
        });

        // Modificar la tabla contratos para hacer la columna id_pagare compatible
        Schema::table('contratos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pagare')->change();
            $table->foreign('id_pagare')->references('id')->on('pagares');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropForeign(['id_pagare']);
            $table->bigInteger('id_pagare')->change();
        });
        
        Schema::dropIfExists('pagares');
    }
};
