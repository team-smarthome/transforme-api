<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matra extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'matra';
    public $incrementing = false;
    protected $keyType = 'uuid';
    public $timestamps = true;
    protected $fillable = ['nama_matra'];
}
