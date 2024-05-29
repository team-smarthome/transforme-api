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
        Schema::create('barang_bukti_kasus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kasus_id')->nullable(false);
            $table->string('nama_bukti_kasus', 100)->nullable();
            $table->string('nomor_barang_bukti', 100)->nullable();
            $table->string('dokumen_barang_bukti', 100)->nullable();
            $table->string('gambar_barang_bukti', 255)->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->date('tanggal_diambil')->nullable();
            $table->string('longitude', 100)->nullable();
            $table->uuid('jenis_perkara_id', 100)->nullable(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kasus_id')->references('id')->on('kasus');
            $table->foreign('jenis_perkara_id')->references('id')->on('jenis_perkara');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_bukti_kasus');
    }
};
