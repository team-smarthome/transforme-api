<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('aktivitas_pengunjung', function (Blueprint $table) {
      $table->uuid('aktivitas_pengunjung_id')->primary();
      $table->string('nama_aktivitas_pengunjung', 100)->nullable();
      $table->dateTime('waktu_mulai_kunjungan')->nullable();
      $table->dateTime('waktu_selesai_kunjungan')->nullable();
      $table->string('tujuan_kunjungan', 100)->nullable();
      $table->uuid('ruangan_otmil_id')->nullable();
      $table->uuid('ruangan_lemasmil_id')->nullable();
      $table->uuid('petugas_id')->nullable();
      $table->uuid('pengunjung_id')->nullable();
      $table->uuid('wbp_profile_id')->nullable();
      $table->string('zona_waktu', 10)->nullable();
      $table->timestamp('d_createdAt')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
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
