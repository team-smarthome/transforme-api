<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumenBap extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'dokumen_bap';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'penyidikan_id',
        'nama_dokumen_bap',
        'link_dokumen_bap',
        'wbp_profile_id',
        'saksi_id'
    ];

    public function penyidikan(): BelongsTo
    {
        return $this->belongsTo(Penyidikan::class, 'penyidikan_id', 'id'); // banyak dokumen bap dimiliki oleh satu penyidikan
    }

    public function wbpProfile(): BelongsTo
    {
        return $this->belongsTo(WbpProfile::class, 'wbp_profile_id', 'id'); // banyak dokumen bap dimiliki oleh satu wbp
    }

    public function saksi(): BelongsTo
    {
        return $this->belongsTo(Saksi::class, 'saksi_id', 'id'); // banyak dokumen bap dimiliki oleh satu saksi
    }

}
