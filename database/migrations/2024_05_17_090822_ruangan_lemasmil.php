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
        Schema::create('ruangan_lemasmils', function (Blueprint $table) {
            $table->uuid("ruangan_lemasmil_id")->primary();
            $table->string("nama_ruangan_lemasmil",100)->nullable(false);
            $table->string("jenis_ruangan_lemasmil",100)->nullable(false);
            $table->foreignUuid("lokasi_lemasmil_id")->nullable();
            $table->softDeletes();
            $table->foreignUuid("zona_id")->nullable();
            $table->double("panjang",8,2)->nullable()->default(0.00);
            $table->double("lebar",8,2)->nullable()->default(0.00);
            $table->double("posisi_X",8,2)->nullable()->default(0.00);
            $table->double("posisi_Y",8,2)->nullable()->default(0.00);
            $table->foreignUuid("lantai_lemasmil_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};