<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kasus extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'kasus';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nama_kasus',
        'nomor_kasus',
        'wbp_profile_id',
        'kategori_perkara_id',
        'jenis_perkara_id',
        'lokasi_kasus',
        'waktu_kejadian',
        'tanggal_pelimpahan_kasus',
        'waktu_pelaporan_kasus',
        'zona_waktu',
        'tanggal_mulai_penyidikan',
        'tanggal_mulai_sidang'
    ];

    public function barangBuktiKasus(): HasMany
    {
        return $this->hasMany(BarangBuktiKasus::class, 'kasus_id', 'id');
    }

    public function wbpProfile(): BelongsTo
    {
        return $this->belongsTo(WbpProfile::class, 'wbp_profile_id', 'id');
    }

    public function kategoriPerkara(): BelongsTo
    {
        return $this->belongsTo(KategoriPerkara::class, 'kategori_perkara_id', 'id');
    }

    public function jenisPerkara(): BelongsTo
    {
        return $this->belongsTo(JenisPerkara::class, 'jenis_perkara_id', 'id');
    }

    public function saksi(): HasMany
    {
        return $this->hasMany(Saksi::class, 'kasus_id', 'id');
    }

    public function penyidikan(): HasMany
    {
        return $this->hasMany(Penyidikan::class, 'kasus_id', 'id');
    }

    public function kasusWbp(): HasMany
    {
        return $this->hasMany(WbpProfile::class, 'kasus_id', 'id');
    }

}