<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Saksi extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $keyType = 'uuid';
    protected $table = 'saksi';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nama_saksi',
        'no_kontak',
        'alamat',
        'jenis_kelamin',
        'kasus_id',
        'keterangan'
    ];

    public function kasus(): BelongsTo
    {
        return $this->belongsTo(Kasus::class, 'kasus_id', 'id'); // banyak saksi dimiliki oleh satu kasus
    }

    public function penyidikan(): BelongsTo
    {
        return $this->belongsTo(Penyidikan::class, 'saksi_id', 'id'); //  banyak saksi dimiliki oleh satu penyidikan
    }
}
