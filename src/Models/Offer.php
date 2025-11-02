<?php

namespace IncadevUns\CoreDomain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    protected $fillable = [
        'title',
        'description',
        'requirements',
        'closing_date',
    ];

    protected $casts = [
        'requirements' => 'array',
        'closing_date' => 'date',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function applicants(): BelongsToMany
    {
        return $this->belongsToMany(
            config('auth.providers.users.model', 'App\Models\User'),
            'applications',
            'offer_id',
            'user_id'
        )->withPivot('cv_path', 'status', 'created_at');
    }
}
