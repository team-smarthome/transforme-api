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
        Schema::create('kegiatan_wbp', function (Blueprint $table) {
            $table->uuid("kegiatan_wbp_id")->primary();
            $table->foreignUuid("wbp_profile_id")->nullable(false);
            $table->foreignUuid("kegiatan_id")->nullable(false);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_wbp');
    }
};
