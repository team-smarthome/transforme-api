<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DokumenPersidangan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $keyType = 'uuid';
    protected $table = 'saksi';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nama_dokumen_persidangan',
        'link_dokumen_persidangan',
        'sidang_id'
    ];

    public function sidang(): BelongsTo
    {
        return $this->belongsTo(Sidang::class, 'sidang_id', 'id');
    }
}
