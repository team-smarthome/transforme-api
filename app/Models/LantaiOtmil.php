<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LantaiOtmil extends Model
{
    use HasFactory, SoftDeletes, HasUuids;
    
    protected $table = "lantai_otmil"    ;
    protected $keyType = "uuid";
    public $incrementing = false;
    public $timestamp = true;

    protected $fillable = [
        'nama_lantai',
        'gedung_otmil_id',
        'lokasi_otmil_id',
        'panjang',
        'lebar',
        'posisi_X',
        'posisi_Y'
    ];

    public function lokasiOtmil(): BelongsTo
    {
        return $this->belongsTo(LokasiOtmil::class, "lokasi_otmil_id", "id");
    }

    public function gedungOtmil(): BelongsTo
    {
        return $this->belongsTo(GedungOtmil::class, "gedung_otmil_id", "id");
    }

    public function ruanganOtmil(): HasMany 
    {
        return $this->hasMany(RuanganOtmil::class, 'lantai_otmil_id', 'id');
    }

}
