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
        Schema::create('dokumen_persidangan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_dokumen_persidangan', 100)->nullable();
            $table->string('link_dokumen_persidangan', 255)->nullable();
            $table->uuid('sidang_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_persidangan');
    }
};
