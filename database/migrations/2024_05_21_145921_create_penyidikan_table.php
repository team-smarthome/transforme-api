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
        Schema::create('penyidikan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nomor_penyidikan', 36)->nullable();
            $table->uuid('kasus_id')->nullable(false);
            $table->date('waktu_dimulai_penyidikan')->nullable();
            $table->string('agenda_penyidikan', 100)->nullable();
            $table->date('waktu_selesai_penyidikan')->nullable();
            $table->uuid('dokumen_bap_id')->nullable();
            $table->uuid('wbp_profile_id')->nullable(false);
            $table->uuid('saksi_id')->nullable(false);
            $table->uuid('oditur_penyidikan_id')->nullable(false);
            $table->string('zona_waktu', 10)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kasus_id')->references('id')->on('kasus');
            $table->foreign('wbp_profile_id')->references('id')->on('wbp_profile');
            $table->foreign('saksi_id')->references('id')->on('saksi');
            $table->foreign('oditur_penyidikan_id')->references('id')->on('oditur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyidikan');
    }
};
