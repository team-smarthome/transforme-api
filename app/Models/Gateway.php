<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Gateway extends Model
{
    use softDeletes, HasUuids;

    protected $table = 'gateway';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */

    protected $fillable = [
        'gmac',
        'nama_gateway',
        'ruangan_otmil_id',
        'ruangan_lemasmil_id',
        'status_gateway',
        'v_gateway_topic'
    ];

    public function ruanganOtmil(): BelongsTo
    {
        return $this->belongsTo(RuanganOtmil::class, 'ruangan_otmil_id', 'id');
    }

    public function ruanganLemasmil(): BelongsTo
    {
        return $this->belongsTo(RuanganLemasmil::class, 'ruangan_lemasmil_id', 'id');
    }

    public function gatewayLog(): HasMany
    {
        return $this->hasMany(GatewayLog::class, 'gateway_id', 'id');
    }

    public function zonaOtmil(): HasOneThrough
    {
        return $this->hasOneThrough(Zona::class, RuanganOtmil::class, 'id', 'id', 'ruangan_otmil_id', 'zona_id');
    }

    public function zonaLemasmil(): HasOneThrough
    {
        return $this->hasOneThrough(Zona::class, RuanganLemasmil::class, 'id', 'id', 'ruangan_lemasmil_id', 'zona_id');
    }

    public function lokasiOtmil (): HasOneThrough
    {
        return $this->hasOneThrough(LokasiOtmil::class, RuanganOtmil::class, 'id', 'id', 'ruangan_otmil_id', 'lokasi_otmil_id');
    }

    public function lokasiLemasmil (): HasOneThrough
    {
        return $this->hasOneThrough(LokasiLemasmil::class, RuanganLemasmil::class, 'id', 'id', 'ruangan_lemasmil_id', 'lokasi_lemasmil_id');
    }
    
}
