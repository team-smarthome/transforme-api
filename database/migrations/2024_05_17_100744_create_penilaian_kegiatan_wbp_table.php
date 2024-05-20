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
        Schema::create('penilaian_kegiatan_wbp', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("wbp_profile_id")->nullable(false);
            $table->foreignUuid("kegiatan_id")->nullable(false);
            $table->string("absensi", 100)->nullable();
            $table->integer("durasi")->nullable();
            $table->integer("nilai")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_kegiatan_wbp');
    }
};
