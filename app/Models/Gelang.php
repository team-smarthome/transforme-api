<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gelang extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'gelang';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'dmac',
        'nama_gelang',
        'tanggal_pasang',
        'tanggal_aktivasi',
        'ruangan_otmil_id',
        'ruangan_lemasmil_id',
        'baterai'
    ];

    public function ruanganOtmil(): BelongsTo
    {
        return $this->belongsTo(RuanganOtmil::class, 'ruangan_otmil_id', 'id');
    }

    public function ruanganLemasmil(): BelongsTo
    {
        return $this->belongsTo(RuanganLemasmil::class, 'ruangan_lemasmil_id', 'id');
    }

    public function gelangWbp()
    {
        return $this->hasOne(WbpProfile::class); // satu gelang punya satu wbp
        // return $this->belongsTo(WbpProfile::class);
        // return $this->belongsTo(WbpProfile::class, 'gelang_id', 'id');
    }

    public function gelangLog(): HasMany
    {
        return $this->hasMany(GelangLog::class, 'gelang_id', 'id');
    }
}
