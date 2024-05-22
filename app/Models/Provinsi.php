<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provinsi extends Model
{
    use SoftDeletes, HasUuids;
    protected $fillable = ['nama_provinsi'];
    protected $table = 'provinsi';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;
}
