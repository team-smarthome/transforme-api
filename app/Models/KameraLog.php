<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KameraLog extends Model
{
  use SoftDeletes, HasUuids;
  protected $table = 'kamera_log';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = [
    'wbp_profile_id',
    'image',
    'kamera_id',
    'foto_wajah_fr'
  ];

  public function wbp_profile(): BelongsTo
  {
    return $this->belongsTo(WbpProfile::class, 'wbp_profile_id', 'id');
  }
  public function kamera(): BelongsTo
  {
    return $this->belongsTo(Kamera::class, 'kamera_id', 'id');
  }
  public function petugas(): BelongsTo
  {
    return $this->belongsTo(Petugas::class, 'foto_wajah_fr', 'foto_wajah_fr');
  }
  public function pengunjung(): BelongsTo
  {
    return $this->belongsTo(Pengunjung::class, 'foto_wajah_fr', 'foto_wajah_fr');
  }
}
