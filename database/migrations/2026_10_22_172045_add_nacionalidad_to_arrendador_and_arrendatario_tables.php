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
        Schema::table('arrendadors', function (Blueprint $table) {
            $table->string('nacionalidad')->nullable();
        });

        Schema::table('arrendatarios', function (Blueprint $table) {
            $table->string('nacionalidad')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arrendadors', function (Blueprint $table) {
            $table->dropColumn('nacionalidad');
        });

        Schema::table('arrendatarios', function (Blueprint $table) {
            $table->dropColumn('nacionalidad');
        });
    }
};
