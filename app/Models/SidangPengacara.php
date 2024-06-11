<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SidangPengacara extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'sidang_pengacara';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['sidang_id', 'nama_pengacara'];

    public function sidang(): BelongsTo
    {
        return $this->belongsTo(Sidang::class, 'sidang_id', 'id');
    }
}
