<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Petugas extends Model
{
  use SoftDeletes, HasUuids;
  protected $table = 'petugas';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = [
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
    'jabatan',
    'divisi',
    'nomor_petugas',
    'lokasi_otmil_id',
    'lokasi_lemasmil_id',
    'grup_petugas_id',
    'nrp',
    'matra_id',
    'foto_wajah_fr',
    'lokasi_kesatuan_id'
  ];


  public function user(): HasMany
  {
    return $this->hasMany(User::class, 'petugas_id', 'id');
  }
  public function pangkat(): BelongsTo
  {
    return $this->belongsTo(Pangkat::class, 'pangkat_id', 'id');
  }
  public function kesatuan(): BelongsTo
  {
    return $this->belongsTo(Kesatuan::class, 'kesatuan_id', 'id');
  }
  public function provinsi(): BelongsTo
  {
    return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
  }
  public function kota(): BelongsTo
  {
    return $this->belongsTo(Kota::class, 'kota_id', 'id');
  }
  public function agama(): BelongsTo
  {
    return $this->belongsTo(Agama::class, 'agama_id', 'id');
  }
  public function status_kawin(): BelongsTo
  {
    return $this->belongsTo(StatusKawin::class, 'status_kawin_id', 'id');
  }
  public function pendidikan(): BelongsTo
  {
    return $this->belongsTo(Pendidikan::class, 'pendidikan_id', 'id');
  }
  public function bidang_keahlian(): BelongsTo
  {
    return $this->belongsTo(BidangKeahlian::class, 'bidang_keahlian_id', 'id');
  }
  public function lokasi_otmil(): BelongsTo
  {
    return $this->belongsTo(LokasiOtmil::class, 'lokasi_otmil_id', 'id');
  }
  public function lokasi_lemasmil(): BelongsTo
  {
    return $this->belongsTo(LokasiLemasmil::class, 'lokasi_lemasmil_id', 'id');
  }
  public function grup_petugas(): BelongsTo
  {
    return $this->belongsTo(GrupPetugas::class, 'grup_petugas_id', 'id');
  }
  public function matra(): BelongsTo
  {
    return $this->belongsTo(Matra::class, 'matra_id', 'id');
  }
  public function lokasi_kesatuan(): BelongsTo
  {
    return $this->belongsTo(LokasiKesatuan::class, 'lokasi_kesatuan_id', 'id');
  }
}
