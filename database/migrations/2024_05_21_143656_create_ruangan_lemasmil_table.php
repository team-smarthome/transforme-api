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
        Schema::create('ruangan_lemasmil', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nama_ruangan_lemasmil",100)->nullable(false);
            $table->string("jenis_ruangan_lemasmil",100)->nullable(false);
            $table->uuid("lokasi_lemasmil_id")->nullable(false);
            $table->uuid("zona_id")->nullable(false);
            $table->double("panjang",8,2)->nullable()->default(0.00);
            $table->double("lebar",8,2)->nullable()->default(0.00);
            $table->double("posisi_X",8,2)->nullable()->default(0.00);
            $table->double("posisi_Y",8,2)->nullable()->default(0.00);
            $table->uuid("lantai_lemasmil_id")->nullable(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("lokasi_lemasmil_id")->references("id")->on("lokasi_lemasmil");
            $table->foreign("zona_id")->references("id")->on("zona");
            $table->foreign("lantai_lemasmil_id")->references("id")->on("lantai_lemasmil");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangan_lemasmil');
    }
};
