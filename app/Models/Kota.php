<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kota extends Model
{
    use SoftDeletes, HasUuids;
    protected $fillable = ['nama_kota'];
    protected $table = 'kota';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    public function pengadilanMiliter()
    {
        return $this->hasMany(PengadilanMiliter::class, 'kota_id', 'id');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }

    public function kotaWbp(): HasMany
    {
        return $this->hasMany(WbpProfile::class, 'kota_id', 'id');
    }

    public function pengunjung()
    {
        return $this->hasMany(Pengunjung::class, 'kota_id', 'id');
    }
    
}
