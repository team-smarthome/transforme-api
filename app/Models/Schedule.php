<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Schedule extends Model
{
  use SoftDeletes, HasUuids;
  protected $table = 'schedule';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = [
    'tanggal',
    'bulan',
    'tahun',
    'shift_id',
  ];

  public function petugas_shift(): HasMany
  {
    return $this->hasMany(PetugasShift::class, 'schedule_id', 'id');
  }
}
