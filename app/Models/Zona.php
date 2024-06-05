<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Zona extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = "zona";
    protected $fillable = ['nama_zona'];
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $hidden = ['created_at', 'updated_at'];

    public function toArray()
    {
        $array = parent::toArray();
        $array['zona_id'] = $array['id'];
        // $array['is_deleted'] = $array['deleted_at'];

        // Periksa apakah 'deleted_at' ada sebelum mengaksesnya
        if (isset($array['deleted_at'])) {
            $array['is_deleted'] = $array['deleted_at'];
        } else {
            $array['is_deleted'] = null; // Atau nilai default yang diinginkan
        }

        unset( $array['id'], $array['deleted_at'] );
        return $array;
    }

    public function ruanganLemasmil()
    {
        return $this->hasMany(RuanganLemasmil::class, 'zona_id', 'id');
    }

    public function ruanganOtmil()
    {
        return $this->hasMany(RuanganOtmil::class, 'zona_id', 'id');
    }
}
