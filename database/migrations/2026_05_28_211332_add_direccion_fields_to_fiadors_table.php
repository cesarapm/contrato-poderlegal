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
        Schema::table('fiadors', function (Blueprint $table) {
            $table->string('numero_inm')->nullable()->after('email');
            $table->string('ciudad')->nullable()->after('domicilio');
            $table->string('estado')->nullable()->after('ciudad');
            $table->string('pais')->default('México')->after('estado');
            $table->string('codigo_postal')->nullable()->after('pais');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fiadors', function (Blueprint $table) {
            $table->dropColumn(['numero_inm', 'ciudad', 'estado', 'pais', 'codigo_postal']);
        });
    }
};
