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
        Schema::create('bap', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('penyidikan_id')->nullable(false);
            $table->uuid('dokumen_bap_id')->nullable(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('penyidikan_id')->references('id')->on('penyidikan');
            $table->foreign('dokumen_bap_id')->references('id')->on('dokumen_bap');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bap');
    }
};
