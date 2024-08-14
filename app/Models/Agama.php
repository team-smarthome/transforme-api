<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agama extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'agama';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['nama_agama'];

    public function agamaWbp(): HasMany
    {
        return $this->hasMany(WbpProfile::class, 'agama_id', 'id');
    }

}
