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
        Schema::create('wbp_profile', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nama", 100)->nullable(false);
            $table->foreignUuid("pangkat_id")->nullable();
            $table->foreignUuid("kesatuan_id")->nullable();
            $table->string("tempat_lahir", 100)->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->tinyInteger("jenis_kelamin")->nullable();
            $table->foreignUuid("provinsi_id")->nullable();
            $table->foreignUuid("kota_id")->nullable();
            $table->string("alamat")->nullable();
            $table->foreignUuid("agama_id")->nullable();
            $table->foreignUuid("status_kawin_id")->nullable();
            $table->foreignUuid("pendidikan_id")->nullable();
            $table->foreignUuid("bidang_keahlian_id")->nullable();
            $table->string("foto_wajah")->nullable();
            $table->string("nomor_tahanan", 100)->nullable();
            $table->tinyInteger("residivis")->nullable();
            $table->foreignUuid("status_wbp_kasus_id")->nullable();
            $table->string("foto_wajah_fr")->nullable();
            $table->tinyInteger("is_isolated")->nullable();
            $table->tinyInteger("is_sick")->nullable();
            $table->string("wbp_sickness")->nullable();
            $table->foreignUuid("gelang_id")->nullable();
            $table->foreignUuid("hunian_wbp_otmil_id")->nullable();
            $table->foreignUuid("hunian_wbp_lemasmil_id")->nullable();
            $table->string("status_keluarga", 100)->nullable();
            $table->string("nama_kontak_keluarga")->nullable();
            $table->string("hubungan_kontak_keluarga")->nullable();
            $table->string("nomor_kontak_keluarga", 100)->nullable();
            $table->foreignUuid("matra_id")->nullable();
            $table->string("nrp", 36)->nullable();
            $table->date("tanggal_ditahan_otmil")->nullable();
            $table->date("tanggal_ditahan_lemasmil")->nullable();
            $table->date("tanggal_penetapan_tersangka")->nullable();
            $table->date("tanggal_penetapan_terdakwa")->nullable();
            $table->date("tanggal_penetapan_terpidana")->nullable();
            $table->foreignUuid("kasus_id")->nullable();
            $table->tinyInteger("is_diperbantukan")->nullable();
            $table->date("tanggal_masa_penahanan_otmil")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("pangkat_id")->references("id")->on("pangkat");
            $table->foreign("kesatuan_id")->references("id")->on("kesatuan");
            $table->foreign("provinsi_id")->references("id")->on("provinsi");
            $table->foreign("kota_id")->references("id")->on("kota");
            $table->foreign("agama_id")->references("id")->on("agama");
            $table->foreign("status_kawin_id")->references("id")->on("status_kawin");
            $table->foreign("pendidikan_id")->references("id")->on("pendidikan");
            $table->foreign("bidang_keahlian_id")->references("id")->on("bidang_keahlian");
            $table->foreign("status_wbp_kasus_id")->references("id")->on("status_wbp_kasus");
            $table->foreign("gelang_id")->references("id")->on("gelang");
            $table->foreign("hunian_wbp_otmil_id")->references("id")->on("hunian_wbp_otmil");
            $table->foreign("hunian_wbp_lemasmil_id")->references("id")->on("hunian_wbp_lemasmil");
            $table->foreign("matra_id")->references("id")->on("matra");
            $table->foreign("kasus_id")->references("id")->on("kasus");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wbp_profile');
    }
};
