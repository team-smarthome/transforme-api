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
        Schema::create('akses_ruangan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('dmac', 255)->nullable();
            $table->string('nama_gateway', 255)->nullable();
            $table->uuid('ruangan_otmil_id')->nullable(false);
            $table->uuid('ruangan_lemasmil_id')->nullable(false);
            $table->uuid('wbp_profile_id')->nullable(false);
            $table->boolean('is_permitted')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ruangan_otmil_id')->references('id')->on('ruangan_otmil');
            $table->foreign('ruangan_lemasmil_id')->references('id')->on('ruangan_lemasmil');
            $table->foreign('wbp_profile_id')->references('id')->on('wbp_profile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akses_ruangan');
    }
};
