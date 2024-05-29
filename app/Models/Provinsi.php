<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Provinsi extends Model
{
    use SoftDeletes, HasUuids;
    protected $fillable = ['nama_provinsi'];
    protected $table = 'provinsi';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    public function pengadilanMiliter()
    {
        return $this->hasMany(PengadilanMiliter::class, 'provinsi_id', 'id');
    }

    public function kota()
    {
        return $this->hasMany(Kota::class, 'provinsi_id', 'id');
    }

    public function provinsiWbp(): HasMany
    {
        return $this->hasMany(WbpProfile::class, 'provinsi_id', 'id');
    }
    
}
