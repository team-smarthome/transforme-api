<?php

namespace App\Models;

use App\Models\Messages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Roomchat extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'roomchat';
    protected $keyType = 'uuid';
    protected $guarded = [];
    public $incrementing = false;
    public $timestamps = true;

    public function message(): BelongsTo
    {
        return $this->belongsTo(Messages::class, "roomName", "id");
    }

}
