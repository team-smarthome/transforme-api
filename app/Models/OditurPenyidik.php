<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OditurPenyidik extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'oditur_penyidik';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['nip', 'nama_oditur', 'alamat'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function toArray()
    {
        $array = parent::toArray();
        $array['oditur_penyidik_id'] = $array['id'];
        unset($array['id']);
        return $array;
    }

    public function penyidikan(): HasMany
    {
        return $this->hasMany(Penyidikan::class, 'oditur_penyidikan_id', 'id');
    }
}
