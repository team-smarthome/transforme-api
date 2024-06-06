<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PivotSidangHakim extends Pivot
{
  use HasUuids, SoftDeletes;

  protected $table = 'pivot_sidang_hakim';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = ['sidang_id', 'role_ketua', 'hakim_id'];

  public function sidang(): BelongsTo
  {
    return $this->belongsTo(Sidang::class, 'sidang_id', 'id');
  }

  public function hakim(): BelongsTo
  {
    return $this->belongsTo(Hakim::class, 'hakim_id', 'id');
  }
}
