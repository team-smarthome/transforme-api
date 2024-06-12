<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class HistoriVonis extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'histori_vonis';

    protected $fillable = [
        'sidang_id',
        'hasil_vonis',
        'masa_tahanan_tahun',
        'masa_tahanan_bulan',
        'masa_tahanan_hari'
    ];

    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    // public function toArray()
    // {
    //     $array = parent::toArray();
    //     $array['histori_vonis_id'] = $array['id'];
    //     unset($array['id']);
    //     return $array;
    // }

    public function sidang(): BelongsTo
    {
        return $this->belongsTo(Sidang::class, 'sidang_id', 'id');
    }
}
