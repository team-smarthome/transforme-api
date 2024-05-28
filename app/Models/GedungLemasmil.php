<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class GedungLemasmil extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'gedung_lemasmil';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    public $fillable = [
        'nama_gedung_lemasmil',
        'lokasi_lemasmil_id',
        'panjang',
        'lebar',
        'posisi_X',
        'posisi_Y',
    ];

    public function lokasiLemasmil(): BelongsTo
    {
        return $this->belongsTo(LokasiLemasmil::class, 'lokasi_lemasmil_id', 'id');
    }
}
