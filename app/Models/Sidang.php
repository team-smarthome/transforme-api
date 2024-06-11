<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sidang extends Model
{
  use SoftDeletes, HasUuids;

  protected $table = 'sidang';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<string>
   */

  protected $fillable = [
    'nama_sidang',
    'jadwal_sidang',
    'perubahan_jadwal_sidang',
    'kasus_id',
    'tanggal_sidang',
    'waktu_mulai_sidang',
    'waktu_selesai_sidang',
    'pengadilan_militer_id',
    'agenda_sidang',
    'hasil_keputusan_sidang',
    'jenis_persidangan_id',
    'juru_sita',
    'juru_pengacara_sidang',
    'pengawas_peradilan_militer',
    'wbp_profile_id',
    'zona_waktu'
  ];


  public function oditurPenuntut(): BelongsToMany
  {
    return $this->belongsToMany(OditurPenuntut::class, 'pivot_sidang_oditur', 'sidang_id', 'oditur_penuntut_id')->withPivot('role_ketua');
  }
  public function pengacara(): BelongsToMany
  {
    return $this->belongsToMany(Pengacara::class, 'sidang_pengacara', 'sidang_id', 'pengacara_id');
  }
  public function hakim(): BelongsToMany
  {
    return $this->belongsToMany(Hakim::class, 'pivot_sidang_hakim', 'sidang_id', 'hakim_id')->withPivot('role_ketua');
  }
  public function ahli(): BelongsToMany
  {
    return $this->belongsToMany(Ahli::class, 'pivot_sidang_ahli', 'sidang_id', 'ahli_id');
  }
  public function saksi(): BelongsToMany
  {
    return $this->belongsToMany(Saksi::class, 'pivot_sidang_saksi', 'sidang_id', 'saksi_id');
  }

  public function kasus(): BelongsTo
  {
    return $this->belongsTo(Kasus::class, 'kasus_id', 'id');
  }

  public function pengadilanMiliter(): BelongsTo
  {
    return $this->belongsTo(PengadilanMiliter::class, 'pengadilan_militer_id', 'id');
  }

  public function jenisPersidangan(): BelongsTo
  {
    return $this->belongsTo(JenisPersidangan::class, 'jenis_persidangan_id', 'id');
  }

  public function wbpProfile(): BelongsTo
  {
    return $this->belongsTo(WbpProfile::class, 'wbp_profile_id', 'id');
  }

  // public function kategoriPerkara(): BelongsTo
  // {
  //   return $this->belongsTo(KategoriPerkara::class, 'kategori_id',  'id');
  // }

  // public function jenisPerkara(): BelongsTo
  // {
  //   return $this->belongsTo(JenisPerkara::class, 'jenis_perkara_id', 'id');
  // }
}
