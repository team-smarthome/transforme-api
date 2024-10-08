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
        Schema::create('schedule', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedTinyInteger('tanggal')->nullable();
            $table->unsignedTinyInteger('bulan')->nullable();
            $table->unsignedSmallInteger('tahun')->nullable();
            $table->uuid('shift_id')->nullable(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('shift_id')->references('id')->on('shift');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule');
    }
};
