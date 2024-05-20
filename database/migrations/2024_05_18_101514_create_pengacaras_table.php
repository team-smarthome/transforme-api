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
        Schema::create('pengacaras', function (Blueprint $table) {
            $table->uuid('pengacara_id')->primary();
            $table->string('nama_pengacara', 100)->nullable();
            $table->string('jenis_pengacara', 100)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengacaras');
    }
};
