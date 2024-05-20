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
        Schema::create('sidang_jaksas', function (Blueprint $table) {
            $table->uuid('sidang_jaksa_id')->primary();
            $table->uuid('sidang_id')->nullable();
            $table->uuid('jaksa_id')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidang_jaksas');
    }
};
