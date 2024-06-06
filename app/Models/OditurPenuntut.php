<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OditurPenuntut extends Model
{
  use SoftDeletes, HasUuids;
  protected $table = 'oditur_penuntut';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;

  protected $fillable = ['nip', 'nama_oditur', 'alamat'];
  protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
  
  public function toArray()
  {
    $array = parent::toArray();
    $array['oditur_penuntut_id'] = $array['id'];
    unset($array['id']);
    return $array;
  }

  public function sidang(): BelongsToMany
  {
    return $this->belongsToMany(Sidang::class, 'pivot_sidang_oditur', 'oditur_penuntut_id', 'sidang_id')->withPivot('role_ketua');
  }
}
