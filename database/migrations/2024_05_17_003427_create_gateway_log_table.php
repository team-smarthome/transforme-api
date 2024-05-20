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
    Schema::create('gateway_log', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('wbp_profile_id')->nullable();
      $table->string('image', 255)->nullable();
      $table->uuid('gateway_id')->nullable();
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('gateway_logs');
  }
};
