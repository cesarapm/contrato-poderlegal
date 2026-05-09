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
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contrato_id')->constrained()->cascadeOnDelete();
            $table->string('codigo_postal', 5);
            $table->string('estado');
            $table->string('alcaldia_municipio');
            $table->string('colonia');
            $table->string('calle');
            $table->string('numero_exterior');
            $table->string('edificio')->nullable();
            $table->string('numero_interior')->nullable();
            $table->string('uso_inmueble');
            $table->foreignId('abogado_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inmuebles');
    }
};
