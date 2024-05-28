<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kasus extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $keyType = 'uuid';
    protected $table = 'kasus';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nomor_kasus',
        'jenis_kasus',
        'lokasi_kesatuan_id',
        'waktu_kejadian',
        'penyidikan_id',
        'keterangan'
    ];

    public function saksi(): HasMany
    {
        return $this->hasMany(Saksi::class, 'kasus_id', 'id');
    }
}
