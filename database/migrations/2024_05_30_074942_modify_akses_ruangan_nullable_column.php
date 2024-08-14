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
        Schema::table('akses_ruangan', function (Blueprint $table) {
            $table->uuid('ruangan_otmil_id')->nullable()->change();
            $table->uuid('ruangan_lemasmil_id')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('akses_ruangan', function (Blueprint $table) {
            $table->uuid('ruangan_otmil_id')->nullable("false")->change();
            $table->uuid('ruangan_lemasmil_id')->nullable("false")->change();
        });
    }
};
