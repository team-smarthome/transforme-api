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
    Schema::create('aktivitas_gelangs', function (Blueprint $table) {
      $table->uuid('aktivitas_gelang_id')->primary();
      $table->string('gmac', 100)->nullable();
      $table->string('dmac', 100)->nullable();
      $table->string('baterai', 100)->nullable();
      $table->string('step', 100)->nullable();
      $table->string('heartrate', 100)->nullable();
      $table->string('temp', 100)->nullable();
      $table->string('spo', 100)->nullable();
      $table->string('systolic', 100)->nullable();
      $table->string('diastolic', 100)->nullable();
      $table->boolean('cutoff_flag')->nullable();
      $table->string('type', 100)->nullable();
      $table->string('x0', 100)->nullable();
      $table->string('y0', 100)->nullable();
      $table->string('z0', 100)->nullable();
      $table->timestamp('timestamp')->nullable();
      $table->softDeletes();
      $table->uuid('wbp_profile_id')->nullable();
      $table->string('rssi', 255)->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('aktivitas_gelangs');
  }
};
