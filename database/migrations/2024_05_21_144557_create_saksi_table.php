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
        Schema::create('saksi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_saksi', 50)->nullable();
            $table->string('no_kontak', 25)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->tinyInteger('jenis_kelamin')->nullable();
            $table->uuid('kasus_id')->nullable(false);
            $table->string('keterangan', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saksi');
    }
};
