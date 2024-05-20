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
        Schema::create('dokumen_persidangans', function (Blueprint $table) {
            $table->uuid('dokumen_persidangan_id')->primary();
            $table->string('nama_dokumen_persidangan', 100)->nullable();
            $table->string('link_dokumen_persidangan', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('sidang_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_persidangans');
    }
};
