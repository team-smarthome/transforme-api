<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Device extends Model
{
    use HasFactory, SoftDeletes, HasUuids;
    protected $table = 'mst_device';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'imei',
        'wearer_name',
        'health_data_periodic',
        'status',
        'is_used',
        'device_type_id',
        'device_model_id',
        'manufacturer_id',
        'firmware_version_id',
        'platform_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function deviceType(): BelongsTo
    {
        return $this->belongsTo(DeviceType::class, 'device_type_id', 'id');
    }

    public function deviceModel(): BelongsTo
    {
        return $this->belongsTo(DeviceModel::class, 'device_model_id', 'id');
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Mst_manufacturer::class, 'manufacturer_id', 'id');
    }
    
    
}

