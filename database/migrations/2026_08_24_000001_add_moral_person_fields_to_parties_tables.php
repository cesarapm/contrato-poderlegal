<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Agregar campos para persona moral a arrendatarios
        Schema::table('arrendatarios', function (Blueprint $table) {
            // Datos de la empresa
            if (!Schema::hasColumn('arrendatarios', 'razon_social')) {
                $table->string('razon_social')->nullable()->after('email');
            }
            if (!Schema::hasColumn('arrendatarios', 'rfc')) {
                $table->string('rfc')->nullable()->after('razon_social');
            }
            if (!Schema::hasColumn('arrendatarios', 'direccion_empresa')) {
                $table->text('direccion_empresa')->nullable()->after('rfc');
            }
            
            // Datos del representante legal
            if (!Schema::hasColumn('arrendatarios', 'representante_legal_nombre')) {
                $table->string('representante_legal_nombre')->nullable()->after('direccion_empresa');
            }
            if (!Schema::hasColumn('arrendatarios', 'representante_legal_email')) {
                $table->string('representante_legal_email')->nullable()->after('representante_legal_nombre');
            }
            if (!Schema::hasColumn('arrendatarios', 'representante_legal_telefono')) {
                $table->string('representante_legal_telefono')->nullable()->after('representante_legal_email');
            }
            if (!Schema::hasColumn('arrendatarios', 'representante_legal_numero_ine')) {
                $table->string('representante_legal_numero_ine')->nullable()->after('representante_legal_telefono');
            }
            if (!Schema::hasColumn('arrendatarios', 'representante_legal_curp')) {
                $table->string('representante_legal_curp')->nullable()->after('representante_legal_numero_ine');
            }
        });

        // Agregar campos para persona moral a arrendadors
        Schema::table('arrendadors', function (Blueprint $table) {
            // Datos de la empresa
            if (!Schema::hasColumn('arrendadors', 'razon_social')) {
                $table->string('razon_social')->nullable()->after('email');
            }
            if (!Schema::hasColumn('arrendadors', 'rfc')) {
                $table->string('rfc')->nullable()->after('razon_social');
            }
            if (!Schema::hasColumn('arrendadors', 'direccion_empresa')) {
                $table->text('direccion_empresa')->nullable()->after('rfc');
            }
            
            // Datos del representante legal
            if (!Schema::hasColumn('arrendadors', 'representante_legal_nombre')) {
                $table->string('representante_legal_nombre')->nullable()->after('direccion_empresa');
            }
            if (!Schema::hasColumn('arrendadors', 'representante_legal_email')) {
                $table->string('representante_legal_email')->nullable()->after('representante_legal_nombre');
            }
            if (!Schema::hasColumn('arrendadors', 'representante_legal_telefono')) {
                $table->string('representante_legal_telefono')->nullable()->after('representante_legal_email');
            }
            if (!Schema::hasColumn('arrendadors', 'representante_legal_numero_ine')) {
                $table->string('representante_legal_numero_ine')->nullable()->after('representante_legal_telefono');
            }
            if (!Schema::hasColumn('arrendadors', 'representante_legal_curp')) {
                $table->string('representante_legal_curp')->nullable()->after('representante_legal_numero_ine');
            }
        });

        // Agregar campos para persona moral a fiadors
        Schema::table('fiadors', function (Blueprint $table) {
            // Datos de la empresa
            if (!Schema::hasColumn('fiadors', 'razon_social')) {
                $table->string('razon_social')->nullable()->after('email');
            }
            if (!Schema::hasColumn('fiadors', 'rfc')) {
                $table->string('rfc')->nullable()->after('razon_social');
            }
            if (!Schema::hasColumn('fiadors', 'direccion_empresa')) {
                $table->text('direccion_empresa')->nullable()->after('rfc');
            }
            
            // Datos del representante legal
            if (!Schema::hasColumn('fiadors', 'representante_legal_nombre')) {
                $table->string('representante_legal_nombre')->nullable()->after('direccion_empresa');
            }
            if (!Schema::hasColumn('fiadors', 'representante_legal_email')) {
                $table->string('representante_legal_email')->nullable()->after('representante_legal_nombre');
            }
            if (!Schema::hasColumn('fiadors', 'representante_legal_telefono')) {
                $table->string('representante_legal_telefono')->nullable()->after('representante_legal_email');
            }
            if (!Schema::hasColumn('fiadors', 'representante_legal_numero_ine')) {
                $table->string('representante_legal_numero_ine')->nullable()->after('representante_legal_telefono');
            }
            if (!Schema::hasColumn('fiadors', 'representante_legal_curp')) {
                $table->string('representante_legal_curp')->nullable()->after('representante_legal_numero_ine');
            }
        });
    }

    public function down(): void
    {
        Schema::table('arrendatarios', function (Blueprint $table) {
            $columns = [
                'razon_social',
                'rfc',
                'direccion_empresa',
                'representante_legal_nombre',
                'representante_legal_email',
                'representante_legal_telefono',
                'representante_legal_numero_ine',
                'representante_legal_curp',
            ];
            foreach ($columns as $column) {
                if (Schema::hasColumn('arrendatarios', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('arrendadors', function (Blueprint $table) {
            $columns = [
                'razon_social',
                'rfc',
                'direccion_empresa',
                'representante_legal_nombre',
                'representante_legal_email',
                'representante_legal_telefono',
                'representante_legal_numero_ine',
                'representante_legal_curp',
            ];
            foreach ($columns as $column) {
                if (Schema::hasColumn('arrendadors', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('fiadors', function (Blueprint $table) {
            $columns = [
                'razon_social',
                'rfc',
                'direccion_empresa',
                'representante_legal_nombre',
                'representante_legal_email',
                'representante_legal_telefono',
                'representante_legal_numero_ine',
                'representante_legal_curp',
            ];
            foreach ($columns as $column) {
                if (Schema::hasColumn('fiadors', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
