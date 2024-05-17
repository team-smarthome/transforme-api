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
        Schema::create('kasuses', function (Blueprint $table) {
            $table->uuid("kasus_id")->primary();
            $table->string("nama_kasus",100)->nullable(false);
            $table->string("nomor_kasus",100)->nullable(false);
            $table->foreignUuid("wbp_profile_id")->nullable(false);
            $table->foreignUuid("kategori_perkara_id")->nullable(false);
            $table->foreignUuid("jenis_perkara_id")->nullable(false);
            $table->softDeletes();
            $table->timestamps();
            $table->string("lokasi_kasus", 255)->nullable();
            $table->dateTime("waktu_kejadian")->nullable();
            $table->date("tanggal_pelimpahan_kasus")->nullable();
            $table->dateTime("waktu_pelaporan_kasus")->nullable();
            $table->string("zona_waktu", 10)->nullable();
            $table->dateTime("tanggal_mulai_penyidikan")->nullable();
            $table->dateTime("tanggal_mulai_sidang")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasuses');
    }
};
