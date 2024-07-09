<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Kegiatan extends Model
{
    use SoftDeletes, HasUuids;

    protected $table = 'kegiatan';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */

    protected $fillable = [
        'nama_kegiatan',
        'nama_kegiatan',
        'ruangan_otmil_id',
        'ruagan_lemasmil_id',
        'status_kegiatan',
        'waktu_mulai_kegiatan',
        'waktu_selesai_kegiatan',
        'zona_waktu',
    ];

    public function ruanganOtmil(): BelongsTo
    {
        return $this->belongsTo(RuanganOtmil::class, 'ruangan_otmil_id', 'id');
    }

    public function ruanganLemasmil(): BelongsTo
    {
        return $this->belongsTo(RuanganLemasmil::class, 'ruangan_lemasmil_id', 'id');
    }

    public function wbpProfile(): BelongsToMany
    {
        return $this->belongsToMany(WbpProfile::class, 'kegiatan_wbp', 'kegiatan_id', 'wbp_profile_id');
    }

    public function kegiatanWbpPivot(): BelongsToMany
    {
        return $this->belongsToMany(WbpProfile::class, 'kegiatan_wbp', 'kegiatan_id', 'wbp_profile_id');
    }

    public function penilaianKegiatanWbp(): HasMany
    {
        return $this->hasMany(PenilaianKegiatanWbp::class, 'kegiatan_id', 'id');
    }
}
