<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penugasan extends Model
{
    use HasFactory;

    public function petugasShift() : HasMany
    {
        return $this->hasMany(PetugasShift::class, 'penugasan_id', 'id');
    }
}
