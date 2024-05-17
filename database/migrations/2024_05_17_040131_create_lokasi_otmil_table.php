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
        Schema::create('lokasi_otmil', function (Blueprint $table) {
            $table->string('lokasi_otmil_id', 36)->primary();
            $table->string('nama_lokasi_otmil', 100)->nullable();
            $table->string('latitude', 100)->nullable();
            $table->string('longitude', 100)->nullable();
            $table->double('panjang', 8, 2)->default(0.00);
            $table->double('lebar', 8, 2)->default(0.00);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_otmil');
    }
};
