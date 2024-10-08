<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // Perbaikan di sini
use Illuminate\Database\Eloquent\SoftDeletes;

class GedungOtmil extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'gedung_otmil';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [ // Perbaikan di sini
        'nama_gedung_otmil',
        'lokasi_otmil_id',
        'panjang',
        'lebar',
        'posisi_X',
        'posisi_Y',
        'pin_X',
        'pin_Y',
        'box_X',
        'box_Y',
        'aspect_ratio',
    ];

    public function lokasiOtmil(): BelongsTo
    {
        return $this->belongsTo(LokasiOtmil::class, 'lokasi_otmil_id', 'id'); // banyak gedung dimiliki oleh satu lokasi otmil
    }

    public function lantaiOtmil(): HasMany
    {
        return $this->hasMany(LantaiOtmil::class, "gedung_otmil_id", "id");
    }
}
