<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Helmet extends Model
{
  use HasFactory, SoftDeletes, HasUuids;

  protected $table = 'helmet';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = [
    'dmac',
    'nama_helmet',
    'tanggal_pasang',
    'tanggal_aktivasi',
    'ruangan_otmil_id',
    'ruangan_lemasmil_id',
    'baterai'
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
