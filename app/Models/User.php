<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes, HasUuids;
    protected $table = 'users';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'username',
        'password',
        'email',
        'phone',
        'user_role_id',
        'lokasi_otmil_id',
        'lokasi_lemasmil_id',
        'is_suspended',
        'petugas_id',
        'image',
        'last_login',
        'expiry_date',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'user_role_id', 'id');
    }
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'petugas_id', 'id');
    }

    public function lokasiOtmil(): BelongsTo
    {
        return $this->belongsTo(LokasiOtmil::class, 'lokasi_otmil_id', 'id');
    }

    public function lokasiLemasmil(): BelongsTo
    {
        return $this->belongsTo(LokasiLemasmil::class, 'lokasi_lemasmil_id', 'id');
    }

}
