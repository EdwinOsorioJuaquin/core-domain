<?php

namespace IncadevUns\CoreDomain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TechAsset extends Model
{
    protected $fillable = [
        'name',
        'type',
        'status',
        'user_id',
        'acquisition_date',
        'expiration_date',
    ];

    protected $casts = [
        'acquisition_date' => 'date',
        'expiration_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model', 'App\Models\User'));
    }
}
