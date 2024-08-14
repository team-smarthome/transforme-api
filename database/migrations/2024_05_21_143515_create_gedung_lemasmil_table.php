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
        Schema::create('gedung_lemasmil', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_gedung_lemasmil', length: 100);
            $table->uuid('lokasi_lemasmil_id')->nullable(false);
            $table->double('panjang', 8, 2)->default(0.00);
            $table->double('lebar', 8, 2)->default(0.00);
            $table->double('posisi_X', 8, 2)->default(0.00);
            $table->double('posisi_Y', 8, 2)->default(0.00);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lokasi_lemasmil_id')->references('id')->on('lokasi_lemasmil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gedung_lemasmil');
    }
};
