<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pangkat extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'pangkat';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = false;
    protected $hidden = ['created_at', 'updated_at'];
    public function toArray()
    {
        $array = parent::toArray();
        $array['pangkat_id'] = $array['id'];
        unset($array['id']);
        return $array;
    }


    protected $fillable = ['nama_pangkat'];

    public function pangkatWbp()
    {
        return $this->hasMany(WbpProfile::class, 'pangkat_id', 'id');
    }
}
