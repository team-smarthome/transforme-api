<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class PivotSidangPengacara extends Pivot
{
    use HasUuids, SoftDeletes;

    protected $table = 'pivot_sidang_pengacara';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['sidang_id', 'pengacara_id'];

    public function sidang(): BelongsTo
    {
      return $this->belongsTo(Sidang::class, 'sidang_id', 'id');
    }

    public function pengacara(): BelongsTo
    {
      return $this->belongsTo(Pengacara::class, 'pengacara_id', 'id');
    }
}
