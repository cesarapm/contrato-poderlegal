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
        Schema::table('contratos', function (Blueprint $table) {
            $table->date('fecha_emision')->nullable()->after('fecha_termino');
            $table->decimal('poliza_precio_completa', 10, 2)->nullable()->comment('Precio sin IVA')->after('monto_renta_mensual');
            $table->decimal('poliza_subtotal', 10, 2)->nullable()->comment('IVA')->after('poliza_precio_completa');
            $table->decimal('poliza_total', 10, 2)->nullable()->comment('Precio con IVA')->after('poliza_subtotal');
            $table->decimal('monto_iva_mensual', 10, 2)->nullable()->after('monto_renta_mensual');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropColumn([
                'fecha_emision',
                'poliza_precio_completa',
                'poliza_subtotal',
                'poliza_total',
                'monto_iva_mensual'
            ]);
        });
    }
};
