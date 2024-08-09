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
    Schema::table('kamera', function (Blueprint $table) {
      $table->double('posisi_X', 15, 8)->nullable()->after('status_kamera');
      $table->double('posisi_Y', 15, 8)->nullable()->after('posisi_X');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('kamera', function (Blueprint $table) {
      $table->dropColumn(['posisi_X', 'posisi_Y']);
    });
  }
};
