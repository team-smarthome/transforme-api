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
        Schema::create('lantai_lemasmils', function (Blueprint $table) {
            $table->uuid("lantai_lemasmil_id")->primary();
            $table->string("nama_lantai",100)->nullable(false);
            $table->softDeletes();
            $table->double("panjang",8,2)->nullable()->default(0.00);
            $table->double("lebar",8,2)->nullable()->default(0.00);
            $table->double("posisi_X",8,2)->nullable()->default(0.00);
            $table->double("posisi_Y",8,2)->nullable()->default(0.00);
            $table->foreignUuid("lokasi_lemasmil_id")->nullable()->oneDelete("cascade");
            $table->foreignUuid("gedung_lemasmil_id")->nullable()->oneDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lantai_lemasmils');
    }
};