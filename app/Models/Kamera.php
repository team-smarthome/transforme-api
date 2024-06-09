<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
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
    'status_kamera'
  ];

  public function ruanganOtmil(): BelongsTo
  {
    return $this->belongsTo(RuanganOtmil::class, 'ruangan_otmil_id', 'id');
  }
  public function ruanganLemasmil(): BelongsTo
  {
    return $this->belongsTo(RuanganLemasmil::class, 'ruangan_lemasmil_id', 'id');
  }
}