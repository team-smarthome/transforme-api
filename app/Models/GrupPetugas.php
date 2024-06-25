<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GrupPetugas extends Model
{
  use SoftDeletes, HasUuids;
  protected $table = 'grup_petugas';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = ['nama_grup_petugas', 'ketua_grup'];

  public function petugas(): HasMany
  {
    return $this->hasMany(Petugas::class, 'grup_petugas_id', 'id');
  }
  public function ketua(): BelongsTo
  {
    return $this->belongsTo(Petugas::class, 'ketua_grup', 'id');
  }
}
