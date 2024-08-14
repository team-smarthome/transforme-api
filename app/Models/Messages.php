<?php

namespace App\Models;

use App\Models\MessagesFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Messages extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'message';
    protected $keyType = 'uuid';
    protected $guarded = [];
    public $incrementing = false;
    public $timestamps = true;

    public function messageFile(): BelongsTo
    {
        return $this->belongsTo(MessagesFile::class, 'message_id', 'id');
    }

    public function roomChat(): HasOne
    {
        return $this->hasOne(RoomChat::class, "id", "roomName");
    }
}
