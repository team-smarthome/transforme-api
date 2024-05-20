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
        Schema::create('wbp_perkara', function (Blueprint $table) {
            $table->uuid("wbp_perkara_id")->primary();
            $table->foreignUuid("kategori_perkara_id")->nullable(false);
            $table->foreignUuid("jenis_perkara_id")->nullable(false);
            $table->integer("vonis_tahun")->nullable();
            $table->integer("vonis_bulan")->nullable();
            $table->integer("vonis_hari")->nullable();
            $table->date("tanggal_ditahan_otmil")->nullable();
            $table->date("tanggal_ditahan_lemasmil")->nullable();
            $table->foreignUuid("lokasi_otmil_id")->nullable(false);
            $table->foreignUuid("lokasi_lemasmil_id")->nullable(false);
            $table->integer("residivis")->nullable();
            $table->softDeletes();
            $table->foreignUuid("wbp_profile_id")->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wbp_perkara');
    }
};
