<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HunianWbpLemasmil extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = "hunian_wbp_lemasmil";
    protected $fillable = [
        'lokasi_lemasmil_id',
        'nama_hunian_wbp_lemasmil'
    ];
    protected $keyType = 'uuid';
    public $timestamps = true;
    public $incrementing = false;

    public function lokasiLemasmil(): BelongsTo{
        return $this->belongsTo(LokasiLemasmil::class,'lokasi_lemasmil_id', 'id');
    }

    public function hunianWBPLemasmil(): HasMany
    {
        return $this->hasMany(WbpProfile::class, 'hunian_wbp_lemasmil_id', 'id');
    }
}
