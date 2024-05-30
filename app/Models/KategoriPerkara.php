<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPerkara extends Model
{
    use SoftDeletes, HasUuids;

    protected $table = "kategori_perkara";
    protected $fillable = [
        'nama_kategori_perkara',
        'jenis_pidana_id'
    ];
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    public function jenisPidana(): BelongsTo
    {
        return $this->belongsTo(JenisPidana::class, 'jenis_pidana_id', 'id');
    }

    public function kategoriPerkara(): HasMany
    {
        return $this->hasMany(Kasus::class, 'kategori_perkara_id', 'id');
    }
}
