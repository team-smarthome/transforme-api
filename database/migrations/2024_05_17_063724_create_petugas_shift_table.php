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
        Schema::create('petugas_shift', function (Blueprint $table) {
            $table->uuid('petugas_shift_id')->primary();
            $table->uuid('shift_id')->nullable();
            $table->uuid('petugas_id')->nullable();
            $table->uuid('schedule_id')->nullable();
            $table->tinyInteger('status_kehadiran')->nullable();
            $table->datetime('jam_kehadiran')->nullable();
            $table->string('status_izin', 100)->nullable();
            $table->uuid('penugasan_id')->nullable();
            $table->uuid('ruangan_otmil_id')->nullable();
            $table->uuid('lokasi_otmil_id')->nullable();
            $table->uuid('ruangan_lemasmil_id')->nullable();
            $table->uuid('lokasi_lemasmil_id')->nullable();
            $table->string('status_pengganti', 36)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('lembur')->nullable();
            $table->string('keterangan_lembur', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas_shift');
    }
};
