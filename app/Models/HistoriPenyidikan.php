<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class HistoriPenyidikan extends Model
{
    use HasFactory;

    protected $table = 'histori_penyidikan';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'penyidikan_id',
        'hasil_penyidikan',
        'lama_masa_tahanan'
    ];

    public function penyidikan()
    {
        return $this->belongsTo(Penyidikan::class, 'penyidikan_id', 'id'); // banyak histori penyidikan dimiliki oleh satu penyidikan
    }
}
