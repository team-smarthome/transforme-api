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
        Schema::create('lantai_otmil', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nama_lantai",100)->nullable(false);
            $table->double("panjang",8,2)->nullable()->default(0.00);
            $table->double("lebar",8,2)->nullable()->default(0.00);
            $table->double("posisi_X",8,2)->nullable()->default(0.00);
            $table->double("posisi_Y",8,2)->nullable()->default(0.00);
            $table->foreignUuid("lokasi_otmil_id")->nullable()->oneDelete("cascade");
            $table->foreignUuid("gedung_otmil_id")->nullable()->oneDelete("cascade");
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lantai_otmil');
    }
};
