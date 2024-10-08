<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_manufacturer extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'mst_manufacturer';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'manufacture',
        'platform_id',
    ];

    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class, 'platform_id', 'id');
    }

    public function devices(): HasMany
    {
        return $this->hasMany(Device::class, 'manufacturer_id', 'id');
    }
}
