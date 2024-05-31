<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PivotSidangAhli extends Pivot
{
  use HasUuids, SoftDeletes;

  protected $table = 'pivot_sidang_ahli';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = ['sidang_id',  'ahli_id'];

  public function sidang(): BelongsTo
  {
    return $this->belongsTo(Sidang::class, 'sidang_id', 'id');
  }

  public function ahli(): BelongsTo
  {
    return $this->belongsTo(Ahli::class, 'ahli_id', 'id');
  }
}
