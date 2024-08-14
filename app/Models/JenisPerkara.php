<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisPerkara extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = "jenis_perkara";
    protected $fillable = [
        'kategori_perkara_id',
        'nama_jenis_perkara',
        'pasal',
        'vonis_tahun_perkara',
        'vonis_bulan_perkara',
        'vonis_hari_perkara',
    ];
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    public function kategoriPerkara(): BelongsTo
    {
        return $this->belongsTo(KategoriPerkara::class,'kategori_perkara_id', 'id');
    }

    public function BarangBuktiKasus(): HasMany
    {
        return $this->hasMany(BarangBuktiKasus::class, 'jenis_perkara_id', 'id');
    }

    public function Kasus(): HasMany
    {
        return $this->hasMany(Kasus::class, 'jenis_perkara_id', 'id');
    }

}
