<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class GrupPetugas extends Model
{
  use SoftDeletes, HasUuids;
  protected $table = 'grup_petugas';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = ['nama_grup_petugas', 'ketua_grup'];
}
