<?php

namespace App\Models;

use App\Models\RuangIsolasiLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WbpProfile extends Model
{
  use SoftDeletes;

  protected $keyType = 'uuid';
  protected $table = 'wbp_profile';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = [
    'id',
    'nama',
    'pangkat_id',
    'kesatuan_id',
    'tempat_lahir',
    'tanggal_lahir',
    'jenis_kelamin',
    'provinsi_id',
    'kota_id',
    'alamat',
    'agama_id',
    'status_kawin_id',
    'pendidikan_id',
    'bidang_keahlian_id',
    'foto_wajah',
    'nomor_tahanan',
    'residivis',
    'status_wbp_kasus_id',
    'foto_wajah_fr',
    'is_isolated',
    'is_sick',
    'wbp_sickness',
    'gelang_id',
    'hunian_wbp_otmil_id',
    'hunian_wbp_lemasmil_id',
    'status_keluarga',
    'nama_kontak_keluarga',
    'hubungan_kontak_keluarga',
    'nomor_kontak_keluarga',
    'matra_id',
    'nrp',
    'tanggal_ditahan_otmil',
    'tanggal_ditahan_lemasmil',
    'tanggal_penetapan_tersangka',
    'tanggal_penetapan_terdakwa',
    'tanggal_penetapan_terpidana',
    'kasus_id',
    'is_diperbantukan',
    'tanggal_masa_penahanan_otmil'
  ];

  public function aktivitasGelangs(): HasMany
  {
    return $this->hasMany(AktivitasGelang::class);
  }

  public function penyidikan(): HasMany
  {
    return $this->hasMany(Penyidikan::class, 'wbp_profile_id', 'id'); // banyak wbp dimiliki oleh satu penyidikan
  }


  // relation profile wbp
  public function pangkat(): BelongsTo
  {
    return $this->belongsTo(Pangkat::class, 'pangkat_id', 'id'); // banyak wbp dimiliki oleh satu pangkat
  }

  public function kesatuan(): BelongsTo
  {
    return $this->belongsTo(Kesatuan::class, 'kesatuan_id', 'id'); // banyak wbp dimiliki oleh satu kesatuan
  }

  public function provinsi(): BelongsTo
  {
    return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id'); // banyak wbp dimiliki oleh satu provinsi
  }

  public function kota(): BelongsTo
  {
    return $this->belongsTo(Kota::class, 'kota_id', 'id'); // banyak wbp dimiliki oleh satu kota
  }

  public function agama(): BelongsTo
  {
    return $this->belongsTo(Agama::class, 'agama_id', 'id'); // banyak wbp dimiliki oleh satu agama
  }

  public function statusKawin(): BelongsTo
  {
    return $this->belongsTo(StatusKawin::class, 'status_kawin_id', 'id'); // banyak wbp dimiliki oleh satu status kawin
  }

  public function pendidikan(): BelongsTo
  {
    return $this->belongsTo(Pendidikan::class, 'pendidikan_id', 'id'); // banyak wbp dimiliki oleh satu pendidikan
  }

  public function bidangKeahlian(): BelongsTo
  {
    return $this->belongsTo(BidangKeahlian::class, 'bidang_keahlian_id', 'id'); // banyak wbp dimiliki oleh satu bidang keahlian
  }

  public function statusWbpKasus(): BelongsTo
  {
    return $this->belongsTo(StatusWbpKasus::class, 'status_wbp_kasus_id', 'id'); // banyak wbp dimiliki oleh satu status wbp kasus
  }

  public function gelang()
  {
    return $this->belongsTo(Gelang::class);
  }

  public function hunianWbpOtmil(): BelongsTo
  {
    return $this->belongsTo(HunianWbpOtmil::class, 'hunian_wbp_otmil_id', 'id');
  }

  public function hunianWbpLemasmil(): BelongsTo
  {
    return $this->belongsTo(HunianWbpLemasmil::class, 'hunian_wbp_lemasmil_id', 'id');
  }

  public function matra(): BelongsTo
  {
    return $this->belongsTo(Matra::class, 'matra_id', 'id');
  }

  public function kasus(): BelongsTo
  {
    return $this->belongsTo(Kasus::class, 'kasus_id', 'id');
  }

  public function aksesRuangan(): HasMany
  {
    return $this->hasMany(AksesRuangan::class, 'wbp_profile_id', 'id');
  }

  public function pengunjung(): HasMany
  {
    return $this->hasMany(Pengunjung::class, 'wbp_profile_id', 'id');
  }

  public function dokumenBap(): HasMany
  {
    return $this->hasMany(DokumenBap::class, 'wbp_profile_id', 'id');
  }

  public function gatewayLog(): HasMany
  {
    return $this->hasMany(GatewayLog::class, 'wbp_profile_id', 'id');
  }

  public function penilaianKegiatanWbp(): HasMany
  {
    return $this->hasMany(PenilaianKegiatanWbp::class, 'wbp_profile_id', 'id');
  }
  public function kamera_log(): HasMany
  {
    return $this->hasMany(KameraLog::class, 'wbp_profile_id', 'id');
  }

  public function RuangIsolasiLog(): BelongsTo 
    {
        return $this->belongsTo(RuangIsolasiLog::class, "wbp_profile_id", "id");
    }
}
