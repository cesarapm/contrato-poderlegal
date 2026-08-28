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
        Schema::table('arrendatarios', function (Blueprint $table) {
            $table->string('numero_ine')->nullable()->after('email');
            $table->string('curp')->nullable()->after('numero_ine');
        });

        Schema::table('arrendadors', function (Blueprint $table) {
            $table->string('numero_ine')->nullable()->after('email');
            $table->string('curp')->nullable()->after('numero_ine');
        });

        Schema::table('fiadors', function (Blueprint $table) {
            $table->string('curp')->nullable()->after('numero_ine');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arrendatarios', function (Blueprint $table) {
            $table->dropColumn(['numero_ine', 'curp']);
        });

        Schema::table('arrendadors', function (Blueprint $table) {
            $table->dropColumn(['numero_ine', 'curp']);
        });

        Schema::table('fiadors', function (Blueprint $table) {
            $table->dropColumn(['curp']);
        });
    }
};
