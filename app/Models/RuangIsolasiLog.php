<?php

namespace App\Models;

use App\Models\WbpProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RuangIsolasiLog extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'ruang_isolasi_log';
    protected $keyType = 'uuid';
    protected $guarded = [];
    public $incrementing = false;
    public $timestamps = true;


    public function wbpProfile(): HasOne 
    {
        return $this->hasOne(WbpProfile::class, "id", "wbp_profile_id");
    }
}
