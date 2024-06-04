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

    public function ruanganLemasmil()
    {
        return $this->hasMany(RuanganLemasmil::class, 'zona_id', 'id');
    }

    public function ruanganOtmil()
    {
        return $this->hasMany(RuanganOtmil::class, 'zona_id', 'id');
    }
}
