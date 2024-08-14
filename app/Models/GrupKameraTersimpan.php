<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GrupKameraTersimpan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'grup_kamera_tersimpan';
    protected $keyType = 'string'; // 'string' instead of 'uuid'
    protected $guarded = [];
    public $incrementing = false;
    public $timestamps = true;

    public function kameraTersimpan(): HasMany
    {
        return $this->hasMany(KameraTersimpan::class, 'grup_id', 'id');
    }
}
