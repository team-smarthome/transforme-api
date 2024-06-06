<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PivotKasusSaksi extends Pivot
{
    use HasUuids, SoftDeletes;

    protected $table = 'pivot_kasus_saksi';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['kasus_id', 'saksi_id', 'keterangan'];

    public function kasus(): BelongsTo
    {
        return $this->belongsTo(Kasus::class, 'kasus_id', 'id');
    }

    public function saksi(): BelongsTo
    {
        return $this->belongsTo(Saksi::class, 'saksi_id', 'id');
    }
}
