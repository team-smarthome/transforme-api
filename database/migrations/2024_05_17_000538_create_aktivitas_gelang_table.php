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
    Schema::create('aktivitas_gelang', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('gmac', 255)->nullable();
      $table->string('dmac', 255)->nullable();
      $table->string('baterai', 255)->nullable();
      $table->string('step', 255)->nullable();
      $table->string('heartrate', 255)->nullable();
      $table->string('temp', 255)->nullable();
      $table->string('spo', 255)->nullable();
      $table->string('systolic', 255)->nullable();
      $table->string('diastolic', 255)->nullable();
      $table->boolean('cutoff_flag')->nullable();
      $table->string('type', 255)->nullable();
      $table->string('x0', 255)->nullable();
      $table->string('y0', 255)->nullable();
      $table->string('z0', 255)->nullable();
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
    Schema::dropIfExists('aktivitas_gelang');
  }
};
