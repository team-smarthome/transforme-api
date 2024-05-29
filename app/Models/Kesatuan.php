<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kesatuan extends Model
{
  use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'kesatuan';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
      'nama_kesatuan',
      'lokasi_kesatuan_id'
    ];

    public function lokasiKesatuan(): BelongsTo
    {
        return $this->belongsTo(LokasiKesatuan::class, 'lokasi_kesatuan_id', 'id'); // banyak kesatuan dimiliki oleh satu lokasi kesatuan
    }

    public function kesatuanWbp():HasMany
    {
        return $this->hasMany(WbpProfile::class, 'kesatuan_id', 'id');
    }
}
