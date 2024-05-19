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
        Schema::create('ruangan_otmils', function (Blueprint $table) {
            $table->uuid("ruangan_otmil_id")->primary();
            $table->string("nama_ruangan_otmil",100)->nullable(false);
            $table->string("jenis_ruangan_otmil",100)->nullable(false);
            $table->foreignUuid("lokasi_otmil_id")->nullable()->oneDelete("cascade");
            $table->softDeletes();
            $table->foreignUuid("zona_id")->nullable()->oneDelete("cascade");
            $table->double("panjang",8,2)->nullable()->default(0.00);
            $table->double("lebar",8,2)->nullable()->default(0.00);
            $table->double("posisi_X",8,2)->nullable()->default(0.00);
            $table->double("posisi_Y",8,2)->nullable()->default(0.00);
            $table->foreignUuid("lantai_otmil_id")->nullable()->oneDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangan_otmils');
    }
};