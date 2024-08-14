<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipeAset extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'tipe_aset';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['nama_tipe'];

    public function aset()
    {
        return $this->hasMany(Aset::class, 'tipe_aset_id', 'id');
    }
}
