<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PetugasShift extends Model
{
  use SoftDeletes, HasUuids;
  protected $table = 'petugas_shift';
  protected $keyType = 'uuid';
  public $incrementing = false;
  public $timestamps = true;
//   protected $hidden = ['created_at', 'updated_at'];

  protected $fillable = [
    'shift_id',
    'petugas_id',
    'schedule_id',
    'status_kehadiran',
    'jam_kehadiran',
    'status_izin',
    'penugasan_id',
    'ruangan_otmil_id',
    'lokasi_otmil_id',
    'ruangan_lemasmil_id',
    'lokasi_lemasmil_id',
    'status_pengganti',
    'lembur',
    'keterangan_lembur',
  ];




  public function shift(): BelongsTo
  {
    return $this->belongsTo(Shift::class, 'shift_id', 'id');
  }
  public function petugas(): BelongsTo
  {
    return $this->belongsTo(Petugas::class, 'petugas_id', 'id');
  }
  public function schedule(): BelongsTo
  {
    return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
  }
  public function penugasan(): BelongsTo
  {
    return $this->belongsTo(Penugasan::class, 'penugasan_id', 'id');
  }
  public function lokasi_otmil(): BelongsTo
  {
    return $this->belongsTo(LokasiOtmil::class, 'lokasi_otmil_id', 'id');
  }
  public function ruangan_otmil(): BelongsTo
  {
    return $this->belongsTo(RuanganOtmil::class, 'ruangan_otmil_id', 'id');
  }
  public function lokasi_lemasmil(): BelongsTo
  {
    return $this->belongsTo(LokasiLemasmil::class, 'lokasi_lemasmil_id', 'id');
  }
  public function ruangan_lemasmil(): BelongsTo
  {
    return $this->belongsTo(RuanganLemasmil::class, 'ruangan_lemasmil_id', 'id');
  }
}
