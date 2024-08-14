<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class HistoriVonis extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'histori_vonis';

    protected $fillable = [
        'id',
        'sidang_id',
        'hasil_vonis',
        'masa_tahanan_tahun',
        'masa_tahanan_bulan',
        'masa_tahanan_hari'
    ];

    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function sidang()
    {
        return $this->belongsTo(Sidang::class, 'sidang_id', 'id');
    }
}
