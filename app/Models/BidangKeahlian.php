<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BidangKeahlian extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = "bidang_keahlian";
    protected $fillable = ['nama_bidang_keahlian'];
    protected $keyType = "uuid";
    public $incrementing = false;
    public $timestamps = true;
}
