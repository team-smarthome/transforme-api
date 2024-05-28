<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penyidikan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $keyType = 'uuid';
    protected $table = 'penyidikan';
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
        'sakski_id',
        'oditur_penyidikan_id',
        'zona_waktu'
    ];

}
