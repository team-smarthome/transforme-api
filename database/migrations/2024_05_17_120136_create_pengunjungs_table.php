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
        Schema::create('pengunjungs', function (Blueprint $table) {
            $table->uuid('pengunjung_id')->primary();
            $table->string('nama', 100)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->tinyInteger('jenis_kelamin')->nullable();
            $table->uuid('provinsi_id')->nullable();
            $table->uuid('kota_id')->nullable();
            $table->string('alamat', 100)->nullable();
            $table->string('foto_wajah', 255)->nullable();
            $table->uuid('wbp_profile_id')->nullable();
            $table->string('hubungan_wbp', 100)->nullable();
            $table->timestamps();
            $table->string('nik', 100)->nullable();
            $table->softDeletes();
            $table->string('foto_wajah_fr', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengunjungs');
    }
};
