<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmartLockerModel extends Model
{
  use HasFactory, SoftDeletes, HasUuids;

  protected $table = 'smartlocker';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = [
    'nama_smartlocker',
    'gmac',
    'ruangan_otmil_id',
    'ruangan_lemasmil_id',
    'status_smartlocker',
    'v_smartlocker_topic',
    'posisi_X',
    'posisi_Y',
  ];

  public function ruanganOtmil(): BelongsTo
  {
    return $this->belongsTo(RuanganOtmil::class, 'ruangan_otmil_id', 'id');
  }
  public function getLantaiOtmilIdAttribute()
  {
    return $this->ruanganOtmil->lantai_otmil_id ?? null;
  }

  public function getGedungOtmilIdAttribute()
  {
    return $this->ruanganOtmil->lantaiOtmil->gedung_otmil_id ?? null;
  }
  public function ruanganLemasmil(): BelongsTo
  {
    return $this->belongsTo(RuanganLemasmil::class, 'ruangan_lemasmil_id', 'id');
  }
}
