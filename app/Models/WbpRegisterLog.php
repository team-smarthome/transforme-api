<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WbpRegisterLog extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'wbp_register_log';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'wbp_profile_id',
        'keterangan',
        'timestamp'
    ];

    public function wbpProfile() : BelongsTo {
        return $this->belongsTo(WbpProfile::class, 'wbp_profile_id', 'id');
    }
}
