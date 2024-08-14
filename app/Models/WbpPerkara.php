<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WbpPerkara extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'wbp_perkara';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'kategori_perkara_id',
        'jenis_perkara_id',
        'vonis_tahun',
        'vonis_bulan',
        'vonis_hari',
        'tanggal_ditahan_otmil',
        'tanggal_ditahan_lemasmil',
        'lokasi_otmil_id',
        'lokasi_lemasmil_id',
        'residivis',
        'wbp_profile_id',
    ];
}
