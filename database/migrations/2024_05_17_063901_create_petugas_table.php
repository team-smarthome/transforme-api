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
        Schema::create('petugas', function (Blueprint $table) {
            $table->uuid('petugas_id')->primary();
            $table->string('nama', 100)->nullable();
            $table->uuid('pangkat_id')->nullable();
            $table->uuid('kesatuan_id')->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->tinyInteger('jenis_kelamin')->nullable();
            $table->uuid('provinsi_id')->nullable();
            $table->uuid('kota_id')->nullable();
            $table->string('alamat', 100)->nullable();
            $table->uuid('agama_id')->nullable();
            $table->uuid('status_kawin_id')->nullable();
            $table->uuid('pendidikan_id')->nullable();
            $table->uuid('bidang_keahlian_id')->nullable();
            $table->string('foto_wajah', 255)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->timestamps(); 
            $table->softDeletes();
            $table->tinyInteger('is_deleted')->default(0);
            $table->string('divisi', 100)->nullable();
            $table->string('nomor_petugas', 100)->nullable();
            $table->uuid('lokasi_otmil_id')->nullable();
            $table->uuid('lokasi_lemasmil_id')->nullable();
            $table->uuid('grup_petugas_id')->nullable();
            $table->string('nrp', 36)->nullable();
            $table->uuid('matra_id')->nullable();
            $table->string('foto_wajah_fr', 255)->nullable();
            $table->uuid('lokasi_kesatuan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas');
    }
};
