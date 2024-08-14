<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LantaiLemasmil extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'lantai_lemasmil';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nama_lantai',
        'panjang',
        'lebar',
        'posisi_X',
        'posisi_Y',
        'lokasi_lemasmil_id',
        'gedung_lemasmil_id'
    ];

    public function lokasiLemasmil(): BelongsTo
    {
        return $this->belongsTo(LokasiLemasmil::class, 'lokasi_lemasmil_id', 'id');
    }

    public function gedungLemasmil(): BelongsTo
    {
        return $this->belongsTo(GedungLemasmil::class, 'gedung_lemasmil_id', 'id');
    }

    public function ruanganLemasmil(): HasMany
    {
        return $this->hasMany(RuanganLemasmil::class, 'lantai_lemasmil_id', 'id');
    }
}
