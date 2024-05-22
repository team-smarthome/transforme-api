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
        Schema::create('pivot_sidang_ahli', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sidang_id')->nullable(false);
            $table->uuid('ahli_id')->nullable(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sidang_id')->references('id')->on('sidang');
            $table->foreign('ahli_id')->references('id')->on('ahli');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_sidang_ahli');
    }
};
