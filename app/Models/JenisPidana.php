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
    public $incrementing = false;
    public $timestamps = true;
}
