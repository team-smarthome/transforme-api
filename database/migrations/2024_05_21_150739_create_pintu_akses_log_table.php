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
        Schema::create('pintu_akses_log', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('wbp_profile_id')->nullable(false);
            $table->string('image', 255)->nullable();
            $table->dateTime('timestamp')->nullable();
            $table->uuid('pintu_akses_id')->nullable(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('wbp_profile_id')->references('id')->on('wbp_profile');
            $table->foreign('pintu_akses_id')->references('id')->on('pintu_akses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pintu_akses_log');
    }
};
