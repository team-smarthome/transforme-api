<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Shift extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'shift';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nama_shift',
        'waktu_mulai',
        'waktu_selesai'
    ];

    public function petugasShift(): HasMany
    {
        return $this->hasMany(PetugasShift::class, 'shift_id', 'id');
    }
}
