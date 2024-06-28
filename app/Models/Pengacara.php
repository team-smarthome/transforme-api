<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pengacara extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'pengacara';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['nama_pengacara', 'jenis_pengacara'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function toArray()
    {
        $array = parent::toArray();
        $array['pengacara_id'] = $array['id'];
        unset($array['id']);
        return $array;
    }

    public function sidang(): BelongsTo
    {
        return $this->belongsTo(Sidang::class, 'sidang_id', 'id');
    }
}
