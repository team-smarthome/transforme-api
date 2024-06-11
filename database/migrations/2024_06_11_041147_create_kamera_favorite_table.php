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
        Schema::create('grup_kamera_tersimpan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_grup')->nullable(false);
            $table->uuid('user_id')->nullable(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });
        
        Schema::create('kamera_tersimpan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kamera_id')->nullable(false);
            $table->uuid('grup_id')->nullable(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kamera_id')->references('id')->on('kamera');
            $table->foreign('grup_id')->references('id')->on('grup_kamera_tersimpan')->onDelete('cascade'); ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grup_kamera_favorite');
        Schema::dropIfExists('kamera_tersimpan');
    }
};
