<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PalmVeinModel extends Model
{
  use HasFactory, SoftDeletes, HasUuids;

  protected $table = 'palm_vein_access_control';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = [
    'nama_palm_vein_access_control',
    'gmac',
    'ruangan_otmil_id',
    'ruangan_lemasmil_id',
    'status_palm_vein_access_control',
    'v_palm_vein_access_control_topic'
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
