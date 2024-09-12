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
    Schema::create('xray_mechine', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('nama_xray_mechine', 100)->nullable();
      $table->string('gmac', 100)->nullable();
      $table->uuid('ruangan_otmil_id')->nullable();
      $table->uuid('ruangan_lemasmil_id')->nullable();
      $table->string('status_xray_mechine', 100)->nullable();
      $table->string('v_xray_mechine_topic', 100)->nullable();
      $table->timestamps();
      $table->softDeletes();
      $table->double('posisi_X', 8, 2)->nullable();
      $table->double('posisi_Y', 8, 2)->nullable();


      $table->foreign('ruangan_otmil_id')->references('id')->on('ruangan_otmil');
      $table->foreign('ruangan_lemasmil_id')->references('id')->on('ruangan_lemasmil');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('xray_mechine');
  }
};
