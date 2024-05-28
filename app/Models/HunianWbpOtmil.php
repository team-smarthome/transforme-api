<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class HunianWbpOtmil extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = "hunian_wbp_otmil";
    protected $fillable = [
        'lokasi_otmil_id',
        'nama_hunian_wbp_otmil'
    ];
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    public function lokasiOtmil(): BelongsTo{
        return $this->belongsTo(LokasiOtmil::class,'lokasi_otmil_id', 'id');
    }
}
