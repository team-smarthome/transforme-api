<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RuanganOtmil extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'ruangan_otmil';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nama_ruangan_otmil',
        'jenis_ruangan_otmil',
        'lokasi_otmil_id',
        'zona_id',
        'panjang',
        'lebar',
        'posisi_X',
        'posisi_Y',
        'lantai_otmil_id'
    ];

    public function gelang(): HasMany
    {
        return $this->hasMany(Gelang::class, 'ruangan_otmil_id', 'id');
    }

}
