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
    Schema::create('gateway', function (Blueprint $table) {
      $table->uuid('gateway_id')->primary();
      $table->string('gmac', 100)->nullable();
      $table->string('nama_gateway', 100)->nullable();
      $table->uuid('ruangan_otmil_id')->nullable();
      $table->uuid('ruangan_lemasmil_id')->nullable();
      $table->string('status_gateway', 100)->nullable();
      $table->string('v_gateway_topic', 100)->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('gateway');
  }
};
