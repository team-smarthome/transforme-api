<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Platform extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'mst_platform';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'platform',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function mstManufacturer(): HasMany
    {
        return $this->hasMany(Mst_manufacturer::class, 'platform_id', 'id');
    }

    public function deviceType(): HasMany
    {
        return $this->hasMany(DeviceType::class, 'platform_id', 'id');
    }

    public function firmwareVersion(): HasMany
    {
        return $this->hasMany(Firmware::class, 'platform_id', 'id');
    }
}


