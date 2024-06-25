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
    Schema::table('grup_petugas', function (Blueprint $table) {
      // Modify the existing ketua_grup column to uuid type
      $table->uuid('ketua_grup')->nullable()->change();

      // Add the foreign key constraint
      $table->foreign('ketua_grup')->references('id')->on('petugas')->onDelete('set null');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('grup_petugas', function (Blueprint $table) {
      // Drop the foreign key constraint
      $table->dropForeign(['ketua_grup']);

      // Change the ketua_grup column back to string type
      $table->string('ketua_grup', 100)->change();
    });
  }
};
