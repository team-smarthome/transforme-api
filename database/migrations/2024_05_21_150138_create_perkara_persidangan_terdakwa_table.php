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
        Schema::create('perkara_persidangan_terdakwa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_perkara_persidangan_terdakwa', 100)->nullable();
            $table->string('nomor_perkara_persidangan_terdakwa', 100)->nullable();
            $table->uuid('wbp_profile_id')->nullable();
            $table->uuid('wbp_perkara_id')->nullable();
            $table->string('status_perkara_persidangan_terdakwa', 100)->nullable();
            $table->date('tanggal_penetapan_terdakwa')->nullable();
            $table->date('tanggal_registrasi_terdakwa')->nullable();
            $table->uuid('oditur_penuntut_id')->nullable();
            $table->integer('lama_proses_persidangan_terdakwa')->nullable();
            $table->uuid('dokumen_bap_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('wbp_profile_id')->references('id')->on('wbp_profile');
            $table->foreign('wbp_perkara_id')->references('id')->on('wbp_perkara');
            $table->foreign('oditur_penuntut_id')->references('id')->on('oditur_penuntut');
            $table->foreign('dokumen_bap_id')->references('id')->on('dokumen_bap');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkara_persidangan_terdakwa');
    }
};
