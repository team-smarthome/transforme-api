<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SelfRegModel extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'm_kiosk';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;  

    protected $fillable = [
        'nama_m_kiosk',
        'gmac',
        'ruangan_otmil_id',
        'ruangan_lemasmil_id',
        'status_m_kiosk',
        'v_m_kiosk_topic'
    ];
    
    public function ruanganOtmil(): BelongsTo
    {
        return $this->belongsTo(RuanganOtmil::class, 'ruangan_otmil_id', 'id');
    }

    public function ruanganLemasmil(): BelongsTo
    {
        return $this->belongsTo(RuanganLemasmil::class, 'ruangan_lemasmil_id', 'id');
    }
}
