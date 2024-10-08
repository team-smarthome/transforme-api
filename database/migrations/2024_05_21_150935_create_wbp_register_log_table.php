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
        Schema::create('wbp_register_log', function (Blueprint $table) {
            $table->id('id');
            $table->uuid('wbp_profile_id')->nullable(false);
            $table->string('keterangan', 100)->nullable();
            $table->dateTime('timestamp')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('wbp_profile_id')->references('id')->on('wbp_profile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wbp_register_log');
    }
};
