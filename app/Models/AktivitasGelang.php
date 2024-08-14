<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AktivitasGelang extends Model
{
    use SoftDeletes, HasUuids;

    protected $table = "aktivitas_gelang";
    protected $fillable = ['gmac', 'dmac', 'baterai', 'step', 'heartrate', 'temp', 'spo', 'systolic', 'diastolic', 'cutoff_flag', 'type', 'x0', 'y0', 'z0', 'wbp_profile_id', 'rssi'];
    protected $keyType = "uuid";
    public $incrementing = false;
    public $timestamps = true;

    public function wbpProfile():BelongsTo
    {
        return $this->belongsTo(WbpProfile::class, 'wbp_profile_id', 'id');
    }
}
