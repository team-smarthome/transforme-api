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
        Schema::create('kesatuan', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nama_kesatuan",100)->nullable(false);
            // $table->foreign('lokasi_kesatuan_id')->references('id')->on('lokasi_kesatuan')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kesatuan');
    }
};
