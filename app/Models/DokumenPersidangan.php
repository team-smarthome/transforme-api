<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class DokumenPersidangan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $keyType = 'uuid';
    protected $table = 'dokumen_persidangan';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'nama_dokumen_persidangan',
        'link_dokumen_persidangan',
        'sidang_id'
    ];

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
