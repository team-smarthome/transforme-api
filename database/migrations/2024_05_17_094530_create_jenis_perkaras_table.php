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
        Schema::create('jenis_perkaras', function (Blueprint $table) {
            $table->uuid("jenis_perkara_id")->primary();
            $table->foreignUuid("kategori_perkara_id")->nullable(false);
            $table->string("nama_jenis_perkara",100)->nullable(false);
            $table->string("pasal",100)->nullable();
            $table->integer("vonis_tahun_perkara")->nullable();
            $table->integer("vonis_bulan_perkara")->nullable();
            $table->integer("vonis_hari_perkara")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_perkaras');
    }
};
