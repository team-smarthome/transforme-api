<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LokasiKesatuan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'lokasi_kesatuan';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['nama_lokasi_kesatuan'];

    public function kesatuan(): HasMany
    {
        return $this->hasMany(Kesatuan::class, 'lokasi_kesatuan_id', 'id'); // satu lokasi kesatuan memiliki banyak kesatuan
    }

}
