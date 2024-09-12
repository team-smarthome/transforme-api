<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class RegistrationKios extends Model
{
    use softDeletes, HasUuids;

    protected $table = 'registration_kios';
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
        'nama_registration_kios',
        'ruangan_otmil_id',
        'ruangan_lemasmil_id',
        'status_registration_kios',
        'v_registration_kios_topic',
        'posisi_X',
        'posisi_Y',
    ];

    public function ruanganOtmil(): BelongsTo
    {
        return $this->belongsTo(RuanganOtmil::class, 'ruangan_otmil_id', 'id');
    }

    public function ruanganLemasmil(): BelongsTo
    {
        return $this->belongsTo(RuanganLemasmil::class, 'ruangan_lemasmil_id', 'id');
    }

    public function getLantaiOtmilIdAttribute()
    {
        return $this->ruanganOtmil->lantai_otmil_id ?? null;
    }

    public function getGedungOtmilIdAttribute()
    {
        return $this->ruanganOtmil->lantaiOtmil->gedung_otmil_id ?? null;
    }
}
