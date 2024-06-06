<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shift extends Model
{
  use SoftDeletes, HasUuids;
  protected $table = 'shift';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = [
    'nama_shift',
    'waktu_mulai',
    'waktu_selesai'
  ];

  protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

  public function toArray()
  {
    $array = parent::toArray();
    $array['shift_id'] = $array['id'];
    unset($array['id']);
    return $array;
  }

  public function petugas_shift(): HasMany
  {
    return $this->hasMany(PetugasShift::class, 'shift_id', 'id');
  }
  public function schedule(): HasOne
  {
    return $this->hasOne(Schedule::class, 'shift_id', 'id');
  }
}
