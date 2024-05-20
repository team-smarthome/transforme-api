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
        Schema::create('pivot_kasus_wbps', function (Blueprint $table) {
            $table->uuid('pivot_kasus_wbp_id')->primary();
            $table->uuid('wbp_profile_id')->nullable();
            $table->uuid('kasus_id')->nullable();
            $table->softDeletes();
            $table->string('keterangan', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_kasus_wbps');
    }
};
