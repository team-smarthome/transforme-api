<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LokasiLemasmil extends Model
{
  use SoftDeletes, HasUuids;
  protected $table = 'lokasi_lemasmil';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = [
    'nama_lokasi_lemasmil',
    'latitude',
    'longitude',
    'panjang',
    'lebar'
  ];

  protected $hidden = ['panjang', 'lebar', 'created_at', 'updated_at', 'deleted_at'];

  public function toArray()
  {
    $array = parent::toArray();
    $array['lokasi_lemasmil_id'] = $array['id'];
    unset($array['id']);
    return $array;
  }

  public function user(): HasMany
  {
    return $this->hasMany(User::class, 'lokasi_lemasmil_id', 'id');
  }

  public function gedungLemasmil(): HasMany
  {
    return $this->hasMany(GedungLemasmil::class, 'lokasi_lemasmil_id', 'id');
  }

  public function lantaiLemasmil(): HasMany
  {
    return $this->hasMany(LantaiLemasmil::class, 'lokasi_lemasmil_id', 'id');
  }


public function petugasShift(): HasMany
{
  return $this->hasMany(PetugasShift::class, 'lokasi_otmil_id', 'id');
}
  public function ruanganLemasmil(): HasMany
  {
    return $this->hasMany(RuanganLemasmil::class, 'lokasi_lemasmil_id', 'id');
  }
}
