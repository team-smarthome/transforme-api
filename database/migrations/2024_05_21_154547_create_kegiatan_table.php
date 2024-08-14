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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nama_kegiatan",100)->nullable(false);
            $table->foreignUuid("ruangan_otmil_id")->nullable();
            $table->foreignUuid("ruangan_lemasmil_id")->nullable();
            $table->string("status_kegiatan",100)->nullable();
            $table->dateTime("waktu_mulai_kegiatan")->nullable();
            $table->dateTime("waktu_selesai_kegiatan")->nullable();
            $table->string("zona_waktu", 10)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("ruangan_otmil_id")->references("id")->on("ruangan_otmil");
            $table->foreign("ruangan_lemasmil_id")->references("id")->on("ruangan_lemasmil");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
