<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;


class AksesRuangan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = "akses_ruangan";
    protected $keyType = "uuid";
    public $incrementing = false;
    public $timestamp = true;

    protected $fillable = [
        'dmac',
        'nama_gateway',
        'ruangan_otmil_id',
        'ruangan_lemasmil_id',
        'wbp_profile_id',
        'is_permitted',
    ];

    public function wbpAkses(): BelongsTo
    {
        return $this->belongsTo(WbpProfile::class, 'wbp_profile_id', 'id');
    }

    public function ruanganOtmilAkses(): BelongsTo
    {
        return $this->belongsTo(RuanganOtmil::class, 'ruangan_otmil_id', 'id');
    }

    public function ruanganLemasmilAkses(): BelongsTo
    {
        return $this->belongsTo(RuanganLemasmil::class, 'ruangan_lemasmil_id', 'id');
    }
    
    public function wbpProfile():HasOne
    {
        return $this->hasOne(WbpProfile::class, 'id', 'wbp_profile_id');
    }

    public function ruanganOtmil(): hasMany
    {
        return $this->hasMany(RuanganOtmil::class, "id", "ruangan_otmil_id");
    }

    public function ruanganLemasmil(): hasMany 
    {
        return $this->hasMany(RuanganLemasmil::class, "id", "ruangan_lemasmil_id");
    }
}
