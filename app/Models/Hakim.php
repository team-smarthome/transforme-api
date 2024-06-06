<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hakim extends Model
{
  use SoftDeletes, HasUuids;
  protected $table = 'hakim';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = ['nip', 'nama_hakim', 'alamat', 'departemen'];

  public function sidang(): BelongsToMany
  {
    return $this->belongsToMany(Sidang::class, 'pivot_sidang_hakim', 'hakim_id', 'sidang_id')->withPivot('role_ketua');
  }
}
