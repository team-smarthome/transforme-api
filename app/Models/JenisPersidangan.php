<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisPersidangan extends Model 
{
    use SoftDeletes, HasUuids; 
    protected $table = "jenis_persidangan";
    protected $keyType = "uuid";
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['nama_jenis_persidangan'];
}
