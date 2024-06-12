<?php

namespace App\Models;

use App\Models\Messages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MessagesFile extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'message_file';
    protected $keyType = 'uuid';
    protected $guarded = [];
    public $incrementing = false;
    public $timestamps = true;

    public function messageFile(): HasOne
    {
        return $this->hasOne(Messages::class, 'id', 'message_id');
    }
}
