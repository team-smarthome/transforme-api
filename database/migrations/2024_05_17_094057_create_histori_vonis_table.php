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
        Schema::create('histori_vonis', function (Blueprint $table) {
            $table->uuid("histori_vonis_id")->primary();
            $table->foreignUuid("sidang_id")->nullable(false);
            $table->string("hasil_vonis",100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string("masa_tahanan_tahun",100)->nullable();
            $table->string("masa_tahanan_bulan",100)->nullable();
            $table->string("masa_tahanan_hari",100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histori_vonis');
    }
};
