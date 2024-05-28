<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Zona extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = "zona";
    protected $fillable = ['nama_zona'];
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;
}
