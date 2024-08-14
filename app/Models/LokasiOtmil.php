<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LokasiOtmil extends Model
{
  use SoftDeletes, HasUuids;
  protected $table = 'lokasi_otmil';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps =  true;
  public function toArray()
  {
    $array = parent::toArray();
    $array['lokasi_otmil_id'] = $array['id'];
    unset($array['id']);
    return $array;
  }

  protected $hidden = ['created_at', 'updated_at', 'panjang', 'lebar', 'deleted_at'];

  protected $fillable = [
    'nama_lokasi_otmil',
    'latitude',
    'longitude',
      'panjang',
      'lebar'
  ];

  public function user(): HasMany
  {
    return $this->hasMany(User::class, 'lokasi_otmil_id', 'id');
  }

  public function gedungOtmil(): HasMany
  {
    return $this->hasMany(GedungOtmil::class, 'lokasi_otmil_id', 'id');
  }

  public function lantaiOtmil(): HasMany
  {
    return $this->hasMany(LantaiOtmil::class, 'lokasi_otmil_id', 'id');
  }

  public function ruanganOtmil(): HasMany
  {
    return $this->hasMany(RuanganOtmil::class, 'lokasi_otmil_id', 'id');
  }
  public function petugas_shift(): HasMany
  {
    return $this->hasMany(PetugasShift::class, 'lokasi_otmil_id', 'id');
  }
}
