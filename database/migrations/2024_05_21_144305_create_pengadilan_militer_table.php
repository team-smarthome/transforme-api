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
        Schema::create('pengadilan_militer', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_pengadilan_militer', 100)->nullable(false);
            $table->uuid('provinsi_id')->nullable(false);
            $table->uuid('kota_id')->nullable(false);
            $table->string('latitude', 100)->nullable();
            $table->string('longitude', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('provinsi_id')->references('id')->on('provinsi');
            $table->foreign('kota_id')->references('id')->on('kota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengadilan_militer');
    }
};
