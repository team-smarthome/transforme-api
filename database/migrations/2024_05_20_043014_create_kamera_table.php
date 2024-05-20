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
    Schema::create('kamera', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('nama_kamera', 100)->nullable();
      $table->string('url_rtsp', 100)->nullable();
      $table->string('ip_address', 100)->nullable();
      $table->uuid('ruangan_otmil_id')->nullable();
      $table->uuid('ruangan_lemasmil_id')->nullable();
      $table->string('merk', 100)->nullable();
      $table->string('model', 100)->nullable();
      $table->string('status_kamera', 100)->nullable();
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('kamera');
  }
};
