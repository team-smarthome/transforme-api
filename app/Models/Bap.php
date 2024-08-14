<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bap extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'bap';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'penyidikan_id',
        'dokumen_bap_id',
    ];

    public function penyidikan(): BelongsTo
    {
        return $this->belongsTo(Penyidikan::class, 'penyidikan_id', 'id');
    }

    public function dokumenBap(): BelongsTo
    {
        return $this->belongsTo(DokumenBap::class, 'dokumen_bap_id', 'id');
    }
}
