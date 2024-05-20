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
        Schema::create('messages_files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('messages_id', length: 36);
            $table->string('namaFile', length: 100);
            $table->string('link_file', length: 100);
            $table->string('link_file_pdf', length: 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages_files');
    }
};
