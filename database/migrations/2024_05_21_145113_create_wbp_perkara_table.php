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
            $table->uuid("id")->primary();
            $table->foreignUuid("kategori_perkara_id")->nullable();
            $table->foreignUuid("jenis_perkara_id")->nullable();
            $table->integer("vonis_tahun")->nullable();
            $table->integer("vonis_bulan")->nullable();
            $table->integer("vonis_hari")->nullable();
            $table->date("tanggal_ditahan_otmil")->nullable();
            $table->date("tanggal_ditahan_lemasmil")->nullable();
            $table->foreignUuid("lokasi_otmil_id")->nullable();
            $table->foreignUuid("lokasi_lemasmil_id")->nullable();
            $table->integer("residivis")->nullable();
            $table->foreignUuid("wbp_profile_id")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("kategori_perkara_id")->references("id")->on("kategori_perkara");
            $table->foreign("jenis_perkara_id")->references("id")->on("jenis_perkara");
            $table->foreign("lokasi_otmil_id")->references("id")->on("lokasi_otmil");
            $table->foreign("lokasi_lemasmil_id")->references("id")->on("lokasi_lemasmil");
            $table->foreign("wbp_profile_id")->references("id")->on("wbp_profile");
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
