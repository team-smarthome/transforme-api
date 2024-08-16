<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelmetTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('helmet', function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->string("dmac", 100)->nullable();
      $table->string("nama_helmet", 100)->nullable(false);
      $table->date("tanggal_pasang")->nullable();
      $table->date("tanggal_aktivasi")->nullable();
      $table->foreignUuid("ruangan_otmil_id")->nullable();
      $table->foreignUuid("ruangan_lemasmil_id")->nullable();
      $table->string("baterai", 100)->nullable();
      $table->timestamps();
      $table->softDeletes();

      $table->foreign("ruangan_otmil_id")->references("id")->on("ruangan_otmil");
      $table->foreign("ruangan_lemasmil_id")->references("id")->on("ruangan_lemasmil");
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('helmet');
  }
}
