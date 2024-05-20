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
        Schema::create('hunian_wbp_lemasmil', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("lokasi_lemasmil_id")->nullable(false)->oneDeleteCascade();
            $table->string("nama_hunian_wbp_lemasmil", 100)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hunian_wbp_lemasmil');
    }
};
