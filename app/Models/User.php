<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids, SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $guarded = [];

  /**
   * Indicates if the model's ID is auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;

  /**
   * The data type of the auto-incrementing ID.
   *
   * @var string
   */
  protected $keyType = 'string';

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'id' => 'string',
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  /**
   * Get the employe associated with the user.
   */
//   public function employee(): BelongsTo
//   {
//     return $this->belongsTo(Employee::class);
//   }

  /**
   * The roles that belong to the user
   */
//   public function roles(): BelongsToMany
//   {
//     return $this->belongsToMany(Role::class)
//       ->withTimestamps();
//   }

//   public function userLogs(): HasMany
//   {
//     return $this->hasMany(UserLog::class);
//   }

  /**
   * The "booted" method of the model.
   */
  // protected static function booted(): void
  // {
  //   static::creating(function (Model $model) {
  //     $model->{$model->getKeyName()} = Str::uuid();
  //   });
  // }

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'nip';
  }

  /**
   * Retrieve the model for a bound value.
   */
//   public function resolveRouteBinding($value, $field = null): Model|null
//   {
//     return $this->whereHas('employee', fn (Builder $query) => $query->where($this->getRouteKeyName(), $value))
//       ->firstOrFail();
//   }
}
