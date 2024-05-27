<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class WbpProfile extends Model
{
    use SoftDeletes, HasUuids;

    public function aktivitasGelangs(){
        return $this->hasMany(AktivitasGelang::class);
    }
}
