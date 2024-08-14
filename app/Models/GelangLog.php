<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class GelangLog extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'gelang_log';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'gelang_id',
        'v_gmac',
        'v_dmac',
        'v_vbatt',
        'v_step',
        'v_heartrate',
        'v_temp',
        'v_spo',
        'v_systolic',
        'v_diastolic',
        'v_rssi',
        'n_cutoff_flag',
        'n_type',
        'v_x0',
        'v_y0',
        'v_z0',
        'd_time',
        'n_isavailable',
        'v_gateway_topic',
    ];

    public function gelang(): BelongsTo
    {
        return $this->belongsTo(Gelang::class, 'gelang_id', 'id');
    }
}
