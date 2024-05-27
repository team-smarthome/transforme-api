<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LokasiOtmil extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'lokasi_otmil';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps =  true;

    protected $fillable = [
        'nama_lokasi_otmil',
        'latitude',
        'longitude',
        'panjang',
        'lebar'
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'lokasi_otmil_id', 'id');
    }

    public function gedungOtmil(): HasMany
    {
        return $this->hasMany(GedungOtmil::class, 'lokasi_otmil_id', 'id');
    }
}
