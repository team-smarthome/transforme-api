<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PivotKasusOditur extends Pivot
{
    use HasUuids, SoftDeletes;

    protected $table = 'pivot_kasus_oditur';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['kasus_id', 'oditur_penyidikan_id', 'keterangan'];

    public function kasus(): BelongsTo
    {
        return $this->belongsTo(Kasus::class, 'kasus_id', 'id');
    }

    public function oditurPenyidik(): BelongsTo
    {
        return $this->belongsTo(OditurPenyidik::class, 'oditur_penyidikan_id', 'id');
    }
}
