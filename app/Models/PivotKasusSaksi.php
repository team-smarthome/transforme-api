<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PivotKasusSaksi extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'pivot_kasus_saksi';
    protected $guarded = [];
    public $incrementing = false;
    public $timestamps = true;
}
