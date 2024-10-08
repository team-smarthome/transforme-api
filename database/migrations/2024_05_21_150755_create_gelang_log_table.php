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
        Schema::create('gelang_log', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('gelang_id')->nullable();
            $table->string('v_gmac', 255)->nullable();
            $table->string('v_dmac', 12)->nullable();
            $table->string('v_vbatt', 100)->nullable();
            $table->string('v_step', 100)->nullable();
            $table->string('v_heartrate', 100)->nullable();
            $table->string('v_temp', 100)->nullable();
            $table->string('v_spo', 100)->nullable();
            $table->string('v_systolic', 100)->nullable();
            $table->string('v_diastolic', 100)->nullable();
            $table->string('v_rssi', 100)->nullable();
            $table->tinyInteger('n_cutoff_flag')->nullable();
            $table->integer('n_type')->nullable();
            $table->string('v_x0', 100)->nullable();
            $table->string('v_y0', 100)->nullable();
            $table->string('v_z0', 100)->nullable();
            $table->dateTime('d_time')->nullable();
            $table->tinyInteger('n_isavailable')->default(1);
            $table->string('v_gateway_topic', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('gelang_id')->references('id')->on('gelang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gelang_log');
    }
};
