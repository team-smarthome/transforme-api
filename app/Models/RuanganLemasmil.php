<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RuanganLemasmil extends Model
{
  use HasFactory, SoftDeletes, HasUuids;

  protected $table = 'ruangan_lemasmil';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = [
    'nama_ruangan_lemasmil',
    'jenis_ruangan_lemasmil',
    'lokasi_lemasmil_id',
    'zona_id',
    'panjang',
    'lebar',
    'posisi_X',
    'posisi_Y',
    'lantai_lemasmil_id'
  ];

  public function gelang(): HasMany
  {
    return $this->hasMany(Gelang::class, 'ruangan_lemasmil_id', 'id');
  }
  public function helmet(): HasMany
  {
    return $this->hasMany(Helmet::class, 'ruangan_lemasmil_id', 'id');
  }
  public function kamera(): HasMany
  {
    return $this->hasMany(Kamera::class, 'ruangan_lemasmil_id', 'id');
  }

  public function lokasiLemasmil(): BelongsTo
  {
    return $this->belongsTo(LokasiLemasmil::class, 'lokasi_lemasmil_id', 'id');
  }

  public function zona(): BelongsTo
  {
    return $this->belongsTo(Zona::class, 'zona_id', 'id');
  }

  public function lantaiLemasmil(): BelongsTo
  {
    return $this->belongsTo(LantaiLemasmil::class, 'lantai_lemasmil_id', 'id');
  }

  public function aksesRuangan(): HasMany
  {
    return $this->hasMany(AksesRuangan::class, "ruangan_lemasmil_id", "id");
  }

  public function kegiatan(): HasMany
  {
    return $this->hasMany(Kegiatan::class, 'ruangan_otmil_id', 'id');
  }
  public function aset(): HasMany
  {
    return $this->hasMany(Aset::class, 'ruangan_lemasmil_id', 'id');
  }

  public function petugas_shift(): HasMany
  {
    return $this->hasMany(PetugasShift::class, 'ruangan_lemasmil_id', 'id');
  }

  public function tv(): HasMany
  {
    return $this->hasMany(TV::class, 'ruangan_lemasmil_id', 'id');
  }

  public function desktop(): HasMany
  {
    return $this->hasMany(Desktop::class, 'ruangan_lemasmil_id', 'id');
  }

  public function accessPoint(): HasMany
  {
    return $this->hasMany(AccessPoint::class, 'ruangan_lemasmil_id', 'id');
  }

  public function accessDoor(): HasMany
  {
    return $this->hasMany(AccessDoor::class, 'ruangan_lemasmil_id', 'id');
  }

  // public function faceRec(): HasMany
  // {
  //   return $this->hasMany(FaceRec::class, "ruangan_lemasmil_id", "id");
  // }

  // public function selfReg(): HasMany
  // {
  //   return $this->hasMany(SelfReg::class, "ruangan_lemasmil_id", "id");
  // }

  public function gateway(): HasMany
  {
    return $this->hasMany(Gateway::class, "ruangan_lemasmil_id", "id");
  }
  
  public function registrationkios(): HasMany
  {
    return $this->hasMany(RegistrationKios::class, "ruangan_lemasmil_id", "id");
  }

  public function emergencypushbutton(): HasMany
  {
    return $this->hasMany(EmergencyPushButton::class, "ruangan_lemasmil_id", "id");
  }
}
