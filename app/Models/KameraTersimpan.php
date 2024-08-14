<?php

namespace App\Models;

use App\Models\Kamera;
use App\Models\GrupKameraTersimpan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KameraTersimpan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'kamera_tersimpan';
    protected $keyType = 'uuid';
    protected $guarded = [];
    public $incrementing = false;
    public $timestamps = true;
    

    public function GrupKameraTersimpan(): BelongsTo
    {
        return $this->belongsTo(GrupKameraTersimpan::class, "id", "grup_id");
    }

    public function Kamera(): HasOne
    {
        return $this->hasOne(Kamera::class, "id", "kamera_id");
    }

    
}
