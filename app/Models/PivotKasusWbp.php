<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PivotKasusWbp extends Pivot
{
    use HasUuids, SoftDeletes;
    protected $table = 'pivot_kasus_wbp';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['kasus_id', 'wbp_profile_id', 'keterangan'];

    public function kasus(): BelongsTo
    {
        return $this->belongsTo(Kasus::class, 'kasus_id', 'id');
    }

    public function wbpProfile(): BelongsTo
    {
        return $this->belongsTo(WbpProfile::class, 'wbp_profile_id', 'id');
    }
}
