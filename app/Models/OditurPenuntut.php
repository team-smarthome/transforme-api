<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OditurPenuntut extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'oditur_penuntut';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['nip', 'nama_oditur', 'alamat'];
}
