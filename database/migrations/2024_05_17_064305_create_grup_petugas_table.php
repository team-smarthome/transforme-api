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
        Schema::create('grup_petugas', function (Blueprint $table) {
            $table->uuid('grup_petugas_id')->primary();
            $table->string('ketua_grup', 100);
            $table->string('nama_grup_petugas', 100);
            $table->timestamps(); 
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grup_petugas');
    }
};
