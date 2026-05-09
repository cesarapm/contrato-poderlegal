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
        Schema::create('arrendatarios', function (Blueprint $table) {
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
            $table->json('domicilio_notificaciones');
            $table->integer('orden')->default(1); // Para multi-inquilino
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrendatarios');
    }
};
