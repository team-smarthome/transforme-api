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
        Schema::create('gedung_otmil', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_gedung_otmil', length: 100);
            $table->uuid('lokasi_otmil_id')->nullable(false);
            $table->double('panjang');
            $table->double('lebar');
            $table->double('posisi_X');
            $table->double('posisi_Y');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lokasi_otmil_id')->references('id')->on('lokasi_otmil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gedung_otmil');
    }
};