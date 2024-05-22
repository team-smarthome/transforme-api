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
        Schema::create('pivot_sidang_oditur', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sidang_id')->nullable(false);
            $table->tinyInteger('role_ketua')->nullable();
            $table->uuid('oditur_penuntut_id')->nullable(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sidang_id')->references('id')->on('sidang');
            $table->foreign('oditur_penuntut_id')->references('id')->on('oditur_penuntut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_sidang_oditur');
    }
};
