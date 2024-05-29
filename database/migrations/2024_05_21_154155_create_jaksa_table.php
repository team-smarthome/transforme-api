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
        Schema::create('jaksa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nrp_jaksa', 100)->nullable();
            $table->string('nama_jaksa', 100)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->string('nomor_telepon', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->string('spesialisasi_hukum', 100)->nullable();
            $table->string('divisi', 100)->nullable();
            $table->string('tanggal_pensiun', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jaksa');
    }
};
