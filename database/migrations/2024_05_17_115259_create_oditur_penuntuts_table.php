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
        Schema::create('oditur_penuntut', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nip', 36)->nullable();
            $table->string('nama_oditur', 100)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oditur_penuntut');
    }
};
