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
        Schema::create('pengunjung', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama', 100)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->tinyInteger('jenis_kelamin')->nullable();
            $table->uuid('provinsi_id')->nullable(false);
            $table->uuid('kota_id')->nullable(false);
            $table->string('alamat', 100)->nullable();
            $table->string('foto_wajah', 255)->nullable();
            $table->uuid('wbp_profile_id')->nullable(false);
            $table->string('hubungan_wbp', 100)->nullable();
            $table->string('nik', 100)->nullable();
            $table->string('foto_wajah_fr', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('provinsi_id')->references('id')->on('provinsi');
            $table->foreign('kota_id')->references('id')->on('kota');
            $table->foreign('wbp_profile_id')->references('id')->on('wbp_profile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengunjung');
    }
};
