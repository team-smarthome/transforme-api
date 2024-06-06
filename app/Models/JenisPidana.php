<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class JenisPidana extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = "jenis_pidana";
    protected $fillable = ["nama_jenis_pidana"];
    protected $keyType = "uuid";
    protected $hidden = ['created_at', 'updated_at'];
    public $incrementing = false;
    public $timestamps = true;
    public function toArray()
    {
        $array = parent::toArray();
        $array['jenis_pidana_id'] = $array['id'];
        unset($array['id']);
        return $array;
    }
}
