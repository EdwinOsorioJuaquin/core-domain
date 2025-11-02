<?php

namespace IncadevUns\CoreDomain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SurveyResponse extends Model
{
    protected $fillable = [
        'survey_id',
        'user_id',
        'rateable_id',
        'rateable_type',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model', 'App\Models\User'));
    }

    public function rateable(): MorphTo
    {
        return $this->morphTo();
    }

    public function responseDetails(): HasMany
    {
        return $this->hasMany(ResponseDetail::class);
    }
}
