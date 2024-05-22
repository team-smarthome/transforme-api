<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Ahli extends Model
{
    use SoftDeletes, HasUuids;
    protected $fillable = ["nama_ahli", "bidang_ahli", "bukti_keahlian"];
    protected $table = "ahli";
    protected $keyType = "uuid";
    public $incrementing = false;
    public $timestamps = true;
}
