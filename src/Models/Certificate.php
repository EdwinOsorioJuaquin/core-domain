<?php

namespace IncadevUns\CoreDomain\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use IncadevUns\CoreDomain\Traits\CanBeAudited;

class Certificate extends Model
{
    use CanBeAudited, HasUuids;

    protected $fillable = [
        'uuid',
        'user_id',
        'group_id',
        'issue_date',
        'extra_data_json',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'extra_data_json' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model', 'App\Models\User'));
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
