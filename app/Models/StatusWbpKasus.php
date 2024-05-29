<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusWbpKasus extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'status_wbp_kasus';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['nama_status_wbp_kasus'];

    public function statusWbpKasus(): HasMany
    {
        return $this->hasMany(WbpProfile::class, 'status_wbp_kasus_id', 'id');
    }
}
