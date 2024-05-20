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
        Schema::create('pivot_sidang_ahlis', function (Blueprint $table) {
            $table->uuid('pivot_sidang_ahli_id')->primary();
            $table->uuid('sidang_id')->nullable();
            $table->uuid('ahli_id')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_sidang_ahlis');
    }
};
