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
        Schema::create('sidang_saksis', function (Blueprint $table) {
            $table->uuid('sidang_saksi_id')->primary();
            $table->uuid('sidang_id')->nullable();
            $table->string('nama_saksi', 255)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidang_saksis');
    }
};
