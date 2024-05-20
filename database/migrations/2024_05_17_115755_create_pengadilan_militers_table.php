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
        Schema::create('pengadilan_militers', function (Blueprint $table) {
            $table->uuid('pengadilan_militer_id')->primary();
            $table->string('nama_pengadilan_militer', 100)->nullable();
            $table->uuid('provinsi_id')->nullable();
            $table->uuid('kota_id')->nullable();
            $table->string('latitude', 100)->nullable();
            $table->string('longitude', 100)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengadilan_militers');
    }
};
