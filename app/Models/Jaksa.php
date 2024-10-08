<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Jaksa extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = "jaksa";
    protected $fillable = [
        'nrp_jaksa',
        'nama_jaksa',
        'alamat',
        'nomor_telepon',
        'email',
        'jabatan',
        'spesialisasi_hukum',
        'divisi',
        'tanggal_pensiun'
    ];
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    public function toArray()
    {
        $array = parent::toArray();
        $array['jaksa_id'] = $array['id'];
        unset($array['id']);
        return $array;
    }
}
