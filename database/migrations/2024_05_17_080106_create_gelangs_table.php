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
        Schema::create('gelangs', function (Blueprint $table) {
            $table->uuid("gelang_id")->primary();
            $table->string("dmac",100)->nullable();
            $table->string("nama_gelang",100)->nullable(false);
            $table->date("tanggal_pasang")->nullable();
            $table->date("tanggal_aktivasi")->nullable();
            $table->foreignUuid("ruangan_otmil_id")->nullable(false);
            $table->foreignUuid("ruangan_lemasmil_id")->nullable(false);
            $table->string("baterai",100)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gelangs');
    }
};
