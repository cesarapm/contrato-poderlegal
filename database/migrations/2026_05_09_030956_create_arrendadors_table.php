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
        Schema::create('arrendadors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contrato_id')->constrained()->cascadeOnDelete();
            $table->enum('tipo_persona', ['fisica', 'moral']);
            $table->string('nombre');
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->string('telefono_1');
            $table->string('telefono_2')->nullable();
            $table->string('email');
            $table->string('identificacion_path')->nullable();
            $table->string('titulo_propiedad_path')->nullable();
            $table->boolean('tiene_representante_legal')->default(false);
            $table->boolean('en_proceso_sucesorio')->default(false);
            $table->json('direccion');
            $table->integer('orden')->default(1); // Para multi-propietario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrendadors');
    }
};
