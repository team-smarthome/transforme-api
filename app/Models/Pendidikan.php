<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pendidikan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'pendidikan';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['nama_pendidikan', 'tahun_lulus'];

    public function pendidikanWbp(): HasMany
    {
        return $this->hasMany(WbpProfile::class, 'pendidikan_id', 'id');
    }
}
