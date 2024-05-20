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
        Schema::create('sidang', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_sidang', 100)->nullable();
            $table->dateTime('jadwal_sidang')->nullable();
            $table->dateTime('perubahan_jadwal_sidang')->nullable();
            $table->uuid('kasus_id')->nullable();
            $table->date('tanggal_sidang')->nullable();
            $table->dateTime('waktu_mulai_sidang')->nullable();
            $table->dateTime('waktu_selesai_sidang')->nullable();
            $table->uuid('pengadilan_militer_id')->nullable();
            $table->string('agenda_sidang', 100)->nullable();
            $table->string('hasil_keputusan_sidang', 100)->nullable();
            $table->uuid('jenis_persidangan_id')->nullable();
            $table->string('juru_sita', 100)->nullable();
            $table->string('juru_pengacara_sidang', 100)->nullable();
            $table->string('pengawas_peradilan_militer', 100)->nullable();
            $table->uuid('wbp_profile_id')->nullable();
            $table->string('zona_waktu', 10)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidang');
    }
};
