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
        Schema::create('dokumen_bap', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('penyidikan_id')->nullable();
            $table->string('nama_dokumen_bap', 100)->nullable();
            $table->string('link_dokumen_bap', 255)->nullable();
            $table->uuid('wbp_profile_id')->nullable(false);
            $table->uuid('saksi_id')->nullable(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('penyidikan_id')->references('id')->on('penyidikan');
            $table->foreign('wbp_profile_id')->references('id')->on('wbp_profile');
            $table->foreign('saksi_id')->references('id')->on('saksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_bap');
    }
};
