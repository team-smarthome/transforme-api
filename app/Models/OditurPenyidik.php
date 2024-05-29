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

    public function penyidikan(): HasMany
    {
        return $this->hasMany(Penyidikan::class, 'oditur_penyidikan_id', 'id');
    }
}
