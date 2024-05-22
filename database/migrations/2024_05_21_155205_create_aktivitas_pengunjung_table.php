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
        Schema::create('aktivitas_pengunjung', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_aktivitas_pengunjung', 100)->nullable();
            $table->dateTime('waktu_mulai_kunjungan')->nullable();
            $table->dateTime('waktu_selesai_kunjungan')->nullable();
            $table->string('tujuan_kunjungan', 100)->nullable();
            $table->uuid('ruangan_otmil_id')->nullable(false);
            $table->uuid('ruangan_lemasmil_id')->nullable(false);
            $table->uuid('petugas_id')->nullable(false);
            $table->uuid('pengunjung_id')->nullable(false);
            $table->uuid('wbp_profile_id')->nullable(false);
            $table->string('zona_waktu', 10)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ruangan_otmil_id')->references('id')->on('ruangan_otmil');
            $table->foreign('ruangan_lemasmil_id')->references('id')->on('ruangan_lemasmil');
            $table->foreign('petugas_id')->references('id')->on('petugas');
            $table->foreign('pengunjung_id')->references('id')->on('pengunjung');
            $table->foreign('wbp_profile_id')->references('id')->on('wbp_profile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas_pengunjung');
    }
};
