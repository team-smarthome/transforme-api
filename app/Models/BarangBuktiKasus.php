<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class BarangBuktiKasus extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'barang_bukti_kasus';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'kasus_id',
        'nama_bukti_kasus',
        'nomor_barang_bukti',
        'dokumen_barang_bukti',
        'gambar_barang_bukti',
        'keterangan',
        'tanggal_diambil',
        'longitude',
        'jenis_perkara_id'
    ];

    public function kasus(): BelongsTo
    {
        return $this->belongsTo(Kasus::class, 'kasus_id', 'id');
    }

    public function jenisPerkara(): BelongsTo
    {
        return $this->belongsTo(JenisPerkara::class, 'jenis_perkara_id', 'id');
    }

}
