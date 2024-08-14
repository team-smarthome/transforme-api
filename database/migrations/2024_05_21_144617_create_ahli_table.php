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
        Schema::create('ahli', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_ahli', 100)->nullable();
            $table->string('bidang_ahli', 100)->nullable();
            $table->string('bukti_keahlian', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ahli');
    }
};
