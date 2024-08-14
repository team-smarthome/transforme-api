<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Penugasan extends Model
{
  use SoftDeletes, HasUuids;
  protected $table = 'penugasan';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = [
    'nama_penugasan'
  ];

  public function petugas_shift(): HasMany
  {
    return $this->hasMany(PetugasShift::class, 'penugasan_id', 'id');
  }
}
