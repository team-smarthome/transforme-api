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
        Schema::create('pintu_akses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_pintu_akses', 100)->nullable();
            $table->string('mac_address', 100)->nullable();
            $table->uuid('ruangan_otmil_id')->nullable(false);
            $table->uuid('ruangan_lemasmil_id')->nullable(false);
            $table->string('status', 100)->nullable();
            $table->string('merk', 100)->nullable();
            $table->string('model', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ruangan_otmil_id')->references('id')->on('ruangan_otmil');
            $table->foreign('ruangan_lemasmil_id')->references('id')->on('ruangan_lemasmil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pintu_akses');
    }
};
