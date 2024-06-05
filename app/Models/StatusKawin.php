<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusKawin extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'status_kawin';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;
    protected $hidden = ['created_at', 'updated_at'];
    public function toArray()
    {
        $array = parent::toArray();
        $array['status_kawin_id'] = $array['id'];
        unset($array['id']);
        return $array;
    }

    protected $fillable = ['nama_status_kawin'];

    public function statusKawinWbp(): HasMany
    {
        return $this->hasMany(WbpProfile::class, 'status_kawin_id', 'id');
    }
}
