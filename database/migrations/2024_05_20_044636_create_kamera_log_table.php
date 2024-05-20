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
    Schema::create('kamera_log', function (Blueprint $table) {
      $table->uuid('kamera_log_id')->primary();
      $table->uuid('wbp_profile_id')->nullable();
      $table->string('image', 255)->nullable();
      $table->timestamp('timestamp')->useCurrent();
      $table->uuid('kamera_id')->nullable();
      $table->string('foto_wajah_fr', 255)->nullable();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('kamera_log');
  }
};
