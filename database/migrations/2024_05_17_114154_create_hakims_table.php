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
        Schema::create('hakims', function (Blueprint $table) {
            $table->uuid('hakim_id')->primary();
            $table->string('nip', 100)->nullable();
            $table->string('nama_hakim', 50)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->string('departemen', 50)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hakims');
    }
};
