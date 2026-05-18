<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['arrendatarios', 'arrendadors', 'fiadors'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->json('ine_paths')->nullable()->after('comprobantes_ingresos');
            });
        }
    }

    public function down(): void
    {
        foreach (['arrendatarios', 'arrendadors', 'fiadors'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('ine_paths');
            });
        }
    }
};
