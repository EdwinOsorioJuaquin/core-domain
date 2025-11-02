<?php

namespace IncadevUns\CoreDomain\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use IncadevUns\CoreDomain\Models\Vote;

trait CanBeVoted
{
    public function votes(): MorphMany
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function upvotes(): MorphMany
    {
        return $this->votes()->where('value', 1);
    }

    public function downvotes(): MorphMany
    {
        return $this->votes()->where('value', -1);
    }

    protected function votesScore(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->votes()->sum('value')
        );
    }
}
