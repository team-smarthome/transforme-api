<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class GatewayLog extends Model
{
    use SoftDeletes, HasUuids;

    protected $table = 'gateway_log';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'wbp_profile_id',
        'image',
        'gateway_id'
    ];

    public function wbpProfile(): BelongsTo
    {
        return $this->belongsTo(WbpProfile::class, 'wbp_profile_id', 'id');
    }

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class, 'gateway_id', 'id');
    }
}