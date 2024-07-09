<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class KegiatanWbp extends Pivot
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'kegiatan_wbp_id',
        'wbp_profile_id',
        'kegiatan_id'
    ];

    protected $table = 'kegiatan_wbp';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    public function wbpProfile(): BelongsTo
    {
        return $this->belongsTo(WbpProfile::class, 'wbp_profile_id', 'id');
    }

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id', 'id');
    }

    public function kegiatanWbpPivot(): BelongsToMany
    {
        return $this->belongsToMany(WbpProfile::class, 'kegiatan_wbp', 'wbp_profile_id', 'kegiatan_id');
    }
}
