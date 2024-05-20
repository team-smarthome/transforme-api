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
    Schema::create('wbp_register_log', function (Blueprint $table) {
      $table->id('id');
      $table->string('wbp_profile_id', 36)->nullable();
      $table->string('keterangan', 100)->nullable();
      $table->dateTime('timestamp')->nullable();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('wbp_register_log');
  }
};
