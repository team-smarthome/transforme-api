<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeviceType extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'mst_device_type';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'type',
        'platform_id',
    ];

    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class, 'platform_id', 'id');
    }

    public function devices(): HasMany
    {
        return $this->hasMany(Device::class, 'device_type_id', 'id');
    }
}
