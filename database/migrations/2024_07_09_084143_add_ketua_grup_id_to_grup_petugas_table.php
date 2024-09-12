<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKetuaGrupIdToGrupPetugasTable extends Migration
{
  public function up()
  {
    Schema::table('grup_petugas', function (Blueprint $table) {
      // Tambahkan kolom ketua_grup_id sebagai UUID
      // $table->uuid('ketua_grup_id')->nullable();

      // // Tambahkan foreign key constraint ke tabel petugas
      // $table->foreign('ketua_grup_id')->references('id')->on('petugas')->onDelete('set null');
    });
  }

  public function down()
  {
    Schema::table('grup_petugas', function (Blueprint $table) {
      // Hapus foreign key constraint
      $table->dropForeign(['ketua_grup_id']);

      // Hapus kolom ketua_grup_id
      $table->dropColumn('ketua_grup_id');
    });
  }
}
