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
        Schema::create('pivot_kasus_oditur', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('oditur_penyidikan_id')->nullable(false);
            $table->tinyInteger('role_ketua')->nullable();
            $table->uuid('kasus_id')->nullable(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('oditur_penyidikan_id')->references('id')->on('oditur_penyidik');
            $table->foreign('kasus_id')->references('id')->on('kasus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_kasus_oditur');
    }
};
