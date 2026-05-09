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
            $table->decimal('monto_renta_mensual', 15, 2)->change();
            $table->decimal('monto_total', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->decimal('monto_renta_mensual', 10, 2)->change();
            $table->decimal('monto_total', 10, 2)->change();
        });
    }
};
