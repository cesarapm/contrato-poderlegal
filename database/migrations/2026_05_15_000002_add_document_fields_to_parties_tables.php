<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $fields = function (Blueprint $table) {
            // Para todos los tipos de persona (física y moral)
            $table->json('comprobantes_ingresos')->nullable()->comment('Mínimo 3 archivos - comprobantes de ingresos');

            // Solo para persona moral
            $table->string('poderes_representante_path')->nullable()->comment('Poderes del representante legal');
            $table->string('constancia_situacion_fiscal_path')->nullable()->comment('Constancia de situación fiscal');
        };

        Schema::table('arrendadors', $fields);
        Schema::table('arrendatarios', $fields);
        Schema::table('fiadors', $fields);
    }

    public function down(): void
    {
        $columns = [
            'comprobantes_ingresos',
            'poderes_representante_path',
            'constancia_situacion_fiscal_path',
        ];

        Schema::table('arrendadors', fn (Blueprint $t) => $t->dropColumn($columns));
        Schema::table('arrendatarios', fn (Blueprint $t) => $t->dropColumn($columns));
        Schema::table('fiadors', fn (Blueprint $t) => $t->dropColumn($columns));
    }
};
