<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aset extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'aset';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nama_aset',
        'tipe_aset_id',
        'ruangan_otmil_id',
        'ruangan_lemasmil_id',
        'kondisi',
        'keterangan',
        'tanggal_masuk',
        'serial_number',
        'model',
        'image',
        'merek',
        'garansi'
    ];

    public function tipeAset(): BelongsTo
    {
        return $this->belongsTo(TipeAset::class, 'tipe_aset_id', 'id');
    }

    public function ruanganOtmil(): BelongsTo
    {
        return $this->belongsTo(RuanganOtmil::class, 'ruangan_otmil_id', 'id');
    }

    public function ruanganLemasmil(): BelongsTo
    {
        return $this->belongsTo(RuanganLemasmil::class, 'ruangan_lemasmil_id', 'id');
    }
}
