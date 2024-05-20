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
        Schema::create('histori_penyidikan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('penyidikan_id')->nullable();
            $table->string('hasil_penyidikan', 100)->nullable();
            $table->string('lama_masa_tahanan', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histori_penyidikan');
    }
};
