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
        Schema::create('user', function (Blueprint $table) {
            $table->uuid('user_id')->primary();
            $table->string('username', 100)->nullable();
            $table->string('password', 100)->nullable();
            $table->uuid('user_role_id')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone', 100)->nullable();
            $table->uuid('lokasi_otmil_id')->nullable();
            $table->uuid('lokasi_lemasmil_id')->nullable();
            $table->tinyInteger('is_suspended')->default(0);
            $table->string('petugas_id', 100)->nullable();
            $table->string('image', 255)->nullable();
            $table->timestamps();
            $table->timestamp('last_login')->nullable();
            $table->date('expiry_date')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
