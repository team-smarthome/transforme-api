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
        Schema::create('lokasi_lemasmil', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nama_lokasi_lemasmil",100)->nullable(false);
            $table->string("latitude",100)->nullable();
            $table->string("langitude",100)->nullable();
            $table->double("panjang",8,2)->nullable()->default(0.00);
            $table->double("lebar",8,2)->nullable()->default(0.00);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_lemasmil');
    }
};
