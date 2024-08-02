<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NVR extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'nvr';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nama_nvr',
        'gmac',
        'ruangan_otmil_id',
        'ruangan_lemasmil_id',
        'status_nvr',
        'v_nvr_topic'
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
