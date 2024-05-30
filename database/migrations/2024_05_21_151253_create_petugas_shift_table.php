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
            $table->uuid('id')->primary();
            $table->uuid('shift_id')->nullable(false);
            $table->uuid('petugas_id')->nullable(false);
            $table->uuid('schedule_id')->nullable(false);
            $table->tinyInteger('status_kehadiran')->nullable();
            $table->datetime('jam_kehadiran')->nullable();
            $table->string('status_izin', 100)->nullable();
            $table->uuid('penugasan_id')->nullable();
            $table->uuid('ruangan_otmil_id')->nullable();
            $table->uuid('lokasi_otmil_id')->nullable();
            $table->uuid('ruangan_lemasmil_id')->nullable();
            $table->uuid('lokasi_lemasmil_id')->nullable();
            $table->string('status_pengganti', 36)->nullable();
            $table->tinyInteger('lembur')->nullable();
            $table->string('keterangan_lembur', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('shift_id')->references('id')->on('shift');
            $table->foreign('petugas_id')->references('id')->on('petugas');
            $table->foreign('schedule_id')->references('id')->on('schedule');
            $table->foreign('penugasan_id')->references('id')->on('penugasan');
            $table->foreign('ruangan_otmil_id')->references('id')->on('ruangan_otmil');
            $table->foreign('lokasi_otmil_id')->references('id')->on('lokasi_otmil');
            $table->foreign('ruangan_lemasmil_id')->references('id')->on('ruangan_lemasmil');
            $table->foreign('lokasi_lemasmil_id')->references('id')->on('lokasi_lemasmil');
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
