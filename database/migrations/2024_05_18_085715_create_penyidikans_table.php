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
        Schema::create('penyidikans', function (Blueprint $table) {
            $table->uuid('penyidikan_id')->primary();
            $table->string('nomor_penyidikan', 36)->nullable();
            $table->uuid('kasus_id')->nullable();
            $table->date('waktu_dimulai_penyidikan')->nullable();
            $table->string('agenda_penyidikan', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->date('waktu_selesai_penyidikan')->nullable();
            $table->uuid('dokumen_bap_id')->nullable();
            $table->uuid('wbp_profile_id')->nullable();
            $table->uuid('saksi_id')->nullable();
            $table->uuid('oditur_penyidikan_id')->nullable();
            $table->string('zona_waktu', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyidikans');
    }
};
