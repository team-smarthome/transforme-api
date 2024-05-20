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
        Schema::create('sidang_pengacaras', function (Blueprint $table) {
            $table->uuid('sidang_pencara_id')->primary();
            $table->uuid('sidang_id')->nullable();
            $table->string('nama_pengacara', 255)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidang_pengacaras');
    }
};
