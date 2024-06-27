<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PivotSidangOditur extends Pivot
{
    use HasUuids, SoftDeletes;

    protected $table = 'pivot_sidang_oditur';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['sidang_id', 'role_ketua_oditur', 'oditur_penuntut_id'];

    public function sidang(): BelongsTo
    {
        return $this->belongsTo(Sidang::class, 'sidang_id', 'id');
    }

    public function oditurPenuntut(): BelongsTo
    {
        return $this->belongsTo(OditurPenuntut::class, 'oditur_penuntut_id', 'id');
    }
}
