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
        Schema::create('pivot_kasus_wbp', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('wbp_profile_id')->nullable(false);
            $table->uuid('kasus_id')->nullable(false);
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('wbp_profile_id')->references('id')->on('wbp_profile');
            $table->foreign('kasus_id')->references('id')->on('kasus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_kasus_wbp');
    }
};
