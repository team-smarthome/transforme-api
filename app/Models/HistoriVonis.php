<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class HistoriVonis extends Model
{
    use HasFactory;

    protected $table = 'histori_vonis';

    protected $fillable = [
        'sidang_id',
        'hasil_vonis',
        'masa_tahanan_tahun',
        'masa_tahanan_bulan',
        'masa_tahanan_hari'
    ];

    public function sidang()
    {
        return $this->belongsTo(Sidang::class);
    }
}
