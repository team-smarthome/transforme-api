<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class Petugas extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'petugas';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'pangkat_id',
        'kesatuan_id',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'provinsi_id',
        'kota_id',
        'alamat',
        'agama_id',
        'status_kawin_id',
        'pendidikan_id',
        'bidang_keahlian_id',
        'foto_wajah',
        'jabatan',
        'divisi',
        'nomor_petugas',
        'lokasi_otmil_id',
        'lokasi_lemasmil_id',
        'grup_petugas_id',
        'nrp',
        'matra_id',
        'foto_wajah_fr',
        'lokasi_kesatuan_id'
    ];


    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'petugas_id', 'id');
    }

}   
