<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penyidikan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'penyidikan';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nomor_penyidikan',
        'kasus_id',
        'waktu_dimulai_penyidikan',
        'agenda_penyidikan',
        'waktu_selesai_penyidikan',
        'dokumen_bap_id',
        'wbp_profile_id',
        'saksi_id',
        'oditur_penyidikan_id',
        'zona_waktu'
    ];

    public function kasus(): BelongsTo
    {
        return $this->belongsTo(Kasus::class, 'kasus_id', 'id'); // banyak penyidikan dimiliki oleh satu kasus
    }

    public function wbpProfile(): BelongsTo
    {
        return $this->belongsTo(WbpProfile::class, 'wbp_profile_id', 'id'); // banyak penyidikan dimiliki oleh satu wbp
    }

    public function saksi(): BelongsTo
    {
        return $this->belongsTo(Saksi::class, 'saksi_id', 'id'); // banyak penyidikan dimiliki oleh satu saksi
    }

    public function oditurPenyidik(): BelongsTo
    {
        return $this->belongsTo(OditurPenyidik::class, 'oditur_penyidikan_id', 'id'); // banyak penyidikan dimiliki oleh satu oditur
    }

    public function bap(): HasMany
    {
        return $this->hasMany(Bap::class, 'penyidikan_id', 'id');
    }
}
