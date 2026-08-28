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
            $table->enum('forma_pago', ['efectivo', 'transferencia'])->default('efectivo')->after('costo_mantenimiento');
            $table->string('banco')->nullable()->after('forma_pago');
            $table->string('clabe')->nullable()->after('banco');
            $table->string('cuenta')->nullable()->after('clabe');
            $table->string('beneficiario')->nullable()->after('cuenta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropColumn(['forma_pago', 'banco', 'clabe', 'cuenta', 'beneficiario']);
        });
    }
};
