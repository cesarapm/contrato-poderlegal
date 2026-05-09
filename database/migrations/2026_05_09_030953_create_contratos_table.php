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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tramitante_id')->constrained();
            $table->foreignId('plantilla_id')->nullable()->constrained('plantilla_contratos');
            $table->string('folio')->unique();
            $table->enum('tipo_producto', ['basica', 'superior', 'empresarial']);
            $table->decimal('monto_renta_mensual', 10, 2);
            $table->decimal('monto_total', 10, 2);
            $table->boolean('incluye_iva')->default(false);
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
            $table->enum('estado', ['borrador', 'pendiente_pago', 'pagado', 'generado', 'firmado'])->default('borrador');
            $table->json('complementos')->nullable(); // Antecedentes crediticios, legales, laborales
            $table->json('datos_renta'); // Forma de pago, depósito, etc.
            $table->json('servicios_inmueble'); // Estacionamiento, mascotas, servicios
            $table->text('observaciones')->nullable();
            $table->string('pdf_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
