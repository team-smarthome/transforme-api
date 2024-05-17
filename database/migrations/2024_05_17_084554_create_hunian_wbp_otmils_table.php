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
        Schema::create('hunian_wbp_otmils', function (Blueprint $table) {
            $table->uuid("hunian_wbp_otmil_id")->primary();
            $table->foreignUuid("lokasi_otmil_id")->nullable(false)->oneDeleteCascade();
            $table->softDeletes();
            $table->string("nama_hunian_wbp_otmil", 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hunian_wbp_otmils');
    }
};
