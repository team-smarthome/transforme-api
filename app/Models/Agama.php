<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Agama extends Model
{
    use HasUuids,SoftDeletes;

    protected $table = 'agama';

    public $incrementing = false;

    protected $keyType = 'string';
    protected $guarded = [];

    // protected $fillable = ['nama_agama'];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         if (empty($model->id)) {
    //             $model->id = (string) Str::uuid();
    //         }
    //     });
    // }
}
