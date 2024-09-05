<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RuanganOtmil extends Model
{
  use HasFactory, SoftDeletes, HasUuids;

  protected $table = "ruangan_otmil";
  protected $keyType = "uuid";
  public $incrementing = false;
  public $timestamp = true;

  protected $fillable = [
    'nama_ruangan_otmil',
    'jenis_ruangan_otmil',
    'lantai_otmil_id',
    'lokasi_otmil_id',
    'zona_id',
    'panjang',
    'lebar',
    'posisi_X',
    'posisi_Y'
  ];

  public function lokasiOtmil(): BelongsTo
  {
    return $this->belongsTo(LokasiOtmil::class, "lokasi_otmil_id", "id");
  }

  public function lantaiOtmil(): BelongsTo
  {
    return $this->belongsTo(LantaiOtmil::class, "lantai_otmil_id", "id");
  }
  public function getGedungOtmilIdAttribute()
  {
    return $this->lantaiOtmil->gedung_otmil_id ?? null;
  }
  public function gelang(): HasMany
  {
    return $this->hasMany(Gelang::class, "ruangan_otmil_id", "id");
  }
  public function helmet(): HasMany
  {
    return $this->hasMany(Helmet::class, "ruangan_otmil_id", "id");
  }
  public function kamera(): HasMany
  {
    return $this->hasMany(Kamera::class, "ruangan_otmil_id", "id");
  }
  public function aset(): HasMany
  {
    return $this->hasMany(Aset::class, "ruangan_otmil_id", "id");
  }

  // public function aksesRuangan(): BelongsTo
  // {
  //     return $this->belongsTo(AksesRuangan::class, "ruangan_otmil_id", "id");
  // }

  public function gateway(): HasMany
  {
    return $this->hasMany(Gateway::class, "ruangan_otmil_id", "id");
  }

  public function zona(): BelongsTo
  {
    return $this->belongsTo(Zona::class, 'zona_id', 'id');
  }

  public function kegiatan(): HasMany
  {
    return $this->hasMany(Kegiatan::class, 'ruangan_otmil_id', 'id');
  }

  public function aksesRuangan(): BelongsTo
  {
    return $this->belongsTo(AksesRuangan::class, "ruangan_otmil_id", "id");
  }
  public function petugas_shift(): HasMany
  {
    return $this->hasMany(PetugasShift::class, "ruangan_otmil_id", "id");
  }

  public function tv(): HasMany
  {
    return $this->hasMany(TV::class, "ruangan_otmil_id", "id");
  }

  public function desktop(): HasMany
  {
    return $this->hasMany(Desktop::class, "ruangan_otmil_id", "id");
  }

  public function accessPoint(): HasMany
  {
    return $this->hasMany(AccessPoint::class, "ruangan_otmil_id", "id");
  }

  public function accessDoor(): HasMany
  {
    return $this->hasMany(AccessDoor::class, "ruangan_otmil_id", "id");
  }

  public function faceRec(): HasMany
  {
    return $this->hasMany(FaceRec::class, "ruangan_otmil_id", "id");
  }

  public function selfReg(): HasMany
  {
    return $this->hasMany(SelfReg::class, "ruangan_otmil_id", "id");
  }
}
