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
        Schema::create('kategori_perkara', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nama_kategori_perkara",100)->nullable(false);
            $table->foreignUuid("jenis_pidana_id")->nullable(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_perkara');
    }
};
