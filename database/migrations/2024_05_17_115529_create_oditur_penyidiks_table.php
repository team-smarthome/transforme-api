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
        Schema::create('oditur_penyidiks', function (Blueprint $table) {
            $table->uuid('oditur_penyidik_id')->primary();
            $table->string('nip', 100)->nullable();
            $table->string('nama_oditur', 100)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oditur_penyidiks');
    }
};
