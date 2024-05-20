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
    Schema::create('pintu_akses_logs', function (Blueprint $table) {
      $table->uuid('pintu_akses_log_id')->primary();
      $table->uuid('wbp_profile_id')->nullable();
      $table->string('image', 255)->nullable();
      $table->dateTime('timestamp')->nullable();
      $table->uuid('pintu_akses_id')->nullable();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('pintu_akses_logs');
  }
};
