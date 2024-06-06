<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengunjung extends Model
{
    use SoftDeletes, HasUuids;

    protected $table = 'pengunjung';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'provinsi_id',
        'kota_id',
        'alamat',
        'foto_wajah',
        'wbp_profile_id',
        'hubungan_wbp',
        'nik',
        'foto_wajah_fr'
    ];

    public function aktivitasPengunjung(): HasMany
    {
        return $this->hasMany(AktivitasPengunjung::class, 'pengunjung_id', 'id');
    }

    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }

    public function kota(): BelongsTo
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }

    public function wbpProfile(): BelongsTo
    {
        return $this->belongsTo(WbpProfile::class, 'wbp_profile_id', 'id');
    }
    
}
