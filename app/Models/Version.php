<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Version extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'version';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    public function toArray()
    {
        $array = parent::toArray();
        $array['version_id'] = $array['id'];
        unset($array['id']);
        return $array;
    }

    protected $fillable = [
        'link',
        'version_name',
    ];
}
