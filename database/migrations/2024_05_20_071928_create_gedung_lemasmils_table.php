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
        Schema::create('gedung_lemasmils', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_lemasmil_id', length: 100);   
            $table->string('lokasi_lemasmil_id', length: 100);
            $table->double('panjang');
            $table->double('lebar');
            $table->double('posisi_X');
            $table->double('posisi_Y');
            $table->softDeletes();
            $table->timestamps();

            // $table->timestamp();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gedung_lemasmils');
    }
};
