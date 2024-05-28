<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RuanganOtmil extends Model
{
    use HasFactory, SoftDeletes, HasUuids;
    
    protected $table = "ruangan_otmil"    ;
    protected $keyType = "uuid";
    public $incrementing = false;
    public $timestamp = true;

    protected $fillable = [
        'nama_ruangan_otmil',
        'jenis_ruangan_otmil',
        'lantai_otmil_id',
        'lokasi_otmil_id',
        'zona_id',
        'panjang',
        'lebar',
        'posisi_X',
        'posisi_Y'
    ];

    public function lokasiOtmil(): BelongsTo
    {
        return $this->belongsTo(LokasiOtmil::class, "lokasi_otmil_id", "id");
    }

    public function lantaiOtmil(): BelongsTo
    {
        return $this->belongsTo(LantaiOtmil::class, "lantai_otmil_id", "id");
    }

}

