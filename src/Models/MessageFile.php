<?php

namespace IncadevUns\CoreDomain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageFile extends Model
{
    protected $fillable = [
        'message_id',
        'type',
        'path',
    ];

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }
}
