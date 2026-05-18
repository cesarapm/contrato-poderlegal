<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $fields = function (Blueprint $table) {
            $table->string('no_acta_constitutiva')->nullable()->after('tipo_persona');
            $table->date('fecha_acta_constitutiva')->nullable()->after('no_acta_constitutiva');
            $table->date('fecha_registro_acta')->nullable()->after('fecha_acta_constitutiva');
            $table->string('estado_inscrita')->nullable()->after('fecha_registro_acta');
            $table->string('acta_constitutiva_path')->nullable()->after('estado_inscrita');
            $table->string('nombre_notario')->nullable()->after('acta_constitutiva_path');
            $table->string('no_notario')->nullable()->after('nombre_notario');
            $table->string('estado_notario')->nullable()->after('no_notario');
            $table->string('ciudad_notario')->nullable()->after('estado_notario');
            $table->string('folio_mercantil')->nullable()->after('ciudad_notario');
            $table->boolean('poder_en_acta')->nullable()->after('folio_mercantil');
        };

        Schema::table('arrendadors', $fields);
        Schema::table('arrendatarios', $fields);
        Schema::table('fiadors', $fields);
    }

    public function down(): void
    {
        $columns = [
            'no_acta_constitutiva',
            'fecha_acta_constitutiva',
            'fecha_registro_acta',
            'estado_inscrita',
            'acta_constitutiva_path',
            'nombre_notario',
            'no_notario',
            'estado_notario',
            'ciudad_notario',
            'folio_mercantil',
            'poder_en_acta',
        ];

        Schema::table('arrendadors', fn (Blueprint $t) => $t->dropColumn($columns));
        Schema::table('arrendatarios', fn (Blueprint $t) => $t->dropColumn($columns));
        Schema::table('fiadors', fn (Blueprint $t) => $t->dropColumn($columns));
    }
};
