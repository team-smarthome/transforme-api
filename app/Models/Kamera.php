<?php

namespace App\Models;



use App\Models\KameraTersimpan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kamera extends Model
{
  use SoftDeletes, HasUuids;
  protected $table = 'kamera';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = [
    'nama_kamera',
    'url_rtsp',
    'ip_address',
    'ruangan_otmil_id',
    'ruangan_lemasmil_id',
    'merk',
    'model',
    'status_kamera',
    'is_play',
    'posisi_X',
    'posisi_Y',
  ];

  public function ruanganOtmil(): BelongsTo
  {
    return $this->belongsTo(RuanganOtmil::class, 'ruangan_otmil_id', 'id');
  }
  public function ruanganLemasmil(): BelongsTo
  {
    return $this->belongsTo(RuanganLemasmil::class, 'ruangan_lemasmil_id', 'id');
  }
  public function kamera_log(): HasMany
  {
    return $this->hasMany(KameraLog::class, 'kamera_id', 'id');
  }

  public function KameraTersimpan(): BelongsTo
  {
    return $this->belongsTo(KameraTersimpan::class, "kamera_id", "id");
  }
}
