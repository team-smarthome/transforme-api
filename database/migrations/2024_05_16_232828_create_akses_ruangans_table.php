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
    Schema::create('akses_ruangan', function (Blueprint $table) {
      $table->uuid('akses_ruangan_id')->primary();
      $table->string('dmac', 100)->nullable();
      $table->string('nama_gateway', 100)->nullable();
      $table->uuid('ruangan_otmil_id')->nullable();
      $table->uuid('ruangan_lemasmil_id')->nullable();
      $table->uuid('wbp_profile_id')->nullable();
      $table->boolean('is_permitted')->nullable();
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('akses_ruangan');
  }
};
