<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('users', function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->string("username",100)->nullable(false);;
      $table->string("password",100)->nullable(false);;
      $table->string("access_token",100)->nullable();
      $table->string("refresh_token",100)->nullable();
      $table->rememberToken();
      $table->string("user_role_id",36)->nullable();;
      $table->string("email",100)->nullable();;
      $table->string("phone",100)->nullable();;
      $table->string("lokasi_otmil_id",36)->nullable();;
      $table->string("lokasi_lemasmil_id",36)->nullable();;
      $table->string("petugas_id",100)->nullable();;
      $table->string("image",100)->nullable();;
      $table->timestamp("expiry_date")->nullable();
      $table->boolean("is_suspend")->default(false);
      $table->timestamp("last_login")->nullable();
      $table->smallInteger("counter_suspend")->default(0);
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
