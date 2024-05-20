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
        Schema::create('pivot_kasus_saksis', function (Blueprint $table) {
            $table->uuid('pivot_kasus_saksi_id')->primary();
            $table->uuid('kasus_id')->nullable();
            $table->uuid('saksi_id')->nullable();
            $table->softDeletes();
            $table->longText('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_kasus_saksis');
    }
};
