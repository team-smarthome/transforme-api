<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function penyidikan(): HasMany
    {
        return $this->hasMany(Penyidikan::class, 'saksi_id', 'id'); // satu saksi memiliki banyak penyidikan
    }

    public function dokumenBap(): HasMany
    {
        return $this->hasMany(DokumenBap::class, 'saksi_id', 'id'); // satu saksi memiliki banyak dokumen bap
    }
}
