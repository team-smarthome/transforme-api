<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AktivitasPengunjung extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'aktivitas_pengunjung';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nama_aktivitas_pengunjung',
        'waktu_mulai_kunjungan',
        'waktu_selesai_kunjungan',
        'tujuan_kunjungan',
        'ruangan_otmil_id',
        'ruangan_lemasmil_id',
        'petugas_id',
        'pengunjung_id',
        'wbp_profile_id',
        'zona_waktu'
    ];

    public function ruanganOtmil(): BelongsTo
    {
        return $this->belongsTo(RuanganOtmil::class, 'ruangan_otmil_id', 'id');
    }

    public function ruanganLemasmil(): BelongsTo
    {
        return $this->belongsTo(RuanganLemasmil::class, 'ruangan_lemasmil_id', 'id');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'petugas_id', 'id');
    }

    public function pengunjung(): BelongsTo
    {
        return $this->belongsTo(Pengunjung::class, 'pengunjung_id', 'id');
    }

    public function wbpProfile(): BelongsTo
    {
        return $this->belongsTo(WbpProfile::class, 'wbp_profile_id', 'id');
    }
}
