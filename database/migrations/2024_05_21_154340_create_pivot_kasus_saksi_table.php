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
        Schema::create('pivot_kasus_saksi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kasus_id')->nullable(false);
            $table->uuid('saksi_id')->nullable(false);
            $table->longText('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kasus_id')->references('id')->on('kasus');
            $table->foreign('saksi_id')->references('id')->on('saksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_kasus_saksi');
    }
};
