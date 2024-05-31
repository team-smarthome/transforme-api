<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Ahli extends Pivot
{
  use SoftDeletes, HasUuids;
  protected $fillable = ["nama_ahli", "bidang_ahli", "bukti_keahlian"];
  protected $table = "ahli";
  protected $keyType = "uuid";
  public $incrementing = false;
  public $timestamps = true;

  public function sidang(): BelongsTo
  {
    return $this->belongsTo(Sidang::class, 'sidang_id', 'id');
  }

  public function ahli(): BelongsTo
  {
    return $this->belongsTo(Ahli::class, 'ahli_id', 'id');
  }
}
