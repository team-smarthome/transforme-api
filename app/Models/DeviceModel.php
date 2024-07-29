<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeviceModel extends Model
{
    use HasFactory, SoftDeletes, HasUuids;
    protected $table = 'mst_device_model';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'model',
        'platform_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class, 'platform_id', 'id');
    }

     public function devices(): HasMany
    {
        return $this->hasMany(Device::class, 'device_model_id', 'id');
    }
}
