<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Platform extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'mst_platform';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
}
