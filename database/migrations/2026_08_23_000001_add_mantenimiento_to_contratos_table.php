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
            $table->boolean('incluye_mantenimiento')->default(false)->after('incluye_iva');
            $table->decimal('costo_mantenimiento', 10, 2)->nullable()->after('incluye_mantenimiento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropColumn(['incluye_mantenimiento', 'costo_mantenimiento']);
        });
    }
};
