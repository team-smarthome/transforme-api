<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaceRec extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'face_rec';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nama_face_rec',
        'gmac',
        'ruangan_otmil_id',
        'ruangan_lemasmil_id',
        'status_face_rec',
        'v_face_rec_topic'
    ];

    public function ruanganOtmil(): BelongsTo
    {
        return $this->belongsTo(RuanganOtmil::class, 'ruangan_otmil_id', 'id');
    }

    public function ruanganLemasmil(): BelongsTo
    {
        return $this->belongsTo(RuanganLemasmil::class, 'ruangan_lemasmil_id', 'id');
    }
}
