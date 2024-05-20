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
        Schema::create('pivot_kasus_oditurs', function (Blueprint $table) {
            $table->uuid('pivot_kasus_oditur_id')->primary();
            $table->uuid('oditur_penyidikan_id')->nullable();
            $table->tinyInteger('role_ketua')->nullable();
            $table->uuid('kasus_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_kasus_oditurs');
    }
};
