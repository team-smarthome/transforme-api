<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Sidang extends Model
{
    use SoftDeletes, HasUuids;

    protected $table = 'sidang';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */

    protected $fillable = [
        'nama_sidang',
        'jadwal_sidang',
        'perubahan_jadwal_sidang',
        'kasus_id',
        'tanggal_sidang',
        'waktu_mulai_sidang',
        'pengadilan_militer_id',
        'agenda_sidang',
        'hasil_keputusan_sidang',
        'jenis_persidangan_id',
        'juru_sita',
        'juru_pengacara_sidang',
        'pengawas_peradilan_militer',
        'wbp_profile_id',
        'zona_waktu'
    ];


    public function oditurPenuntut(): BelongsToMany
    {
        return $this->belongsToMany(OditurPenuntut::class, 'pivot_sidang_oditur', 'sidang_id', 'oditur_penuntut_id')->withPivot('role_ketua');
    }
}
