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
        Schema::create('pivot_sidang_pengacara', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sidang_id')->nullable(false);
            $table->string('nama_pengacara', 255)->nullable();
            $table->string('jenis_pengacara', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sidang_id')->references('id')->on('sidang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_sidang_pengacara');
    }
};
