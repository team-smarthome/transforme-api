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
        Schema::create('aset', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_aset', 100)->nullable();
            $table->uuid('tipe_aset_id')->nullable();
            $table->uuid('ruangan_otmil_id')->nullable();
            $table->uuid('ruangan_lemasmil_id')->nullable();
            $table->string('kondisi', 100)->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->string('serial_number', 100)->nullable();
            $table->string('model', 100)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('merek', 255)->nullable();
            $table->date('garansi')->nullable();
            $table->timestamps(); 
            $table->softDeletes();

            $table->foreign('tipe_aset_id')->references('id')->on('tipe_aset');
            $table->foreign('ruangan_otmil_id')->references('id')->on('ruangan_otmil');
            $table->foreign('ruangan_lemasmil_id')->references('id')->on('ruangan_lemasmil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset');
    }
};
