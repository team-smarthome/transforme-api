<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class UserRole extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'user_role';
    protected $keyType = 'uuid';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'role_name',
        'deskripsi_role',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, "user_role_id", "id");
    }
}
