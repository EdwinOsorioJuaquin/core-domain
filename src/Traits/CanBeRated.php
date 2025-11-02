<?php

namespace IncadevUns\CoreDomain\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use IncadevUns\CoreDomain\Models\SurveyResponse;

trait CanBeRated
{
    public function ratings(): MorphMany
    {
        return $this->morphMany(SurveyResponse::class, 'rateable');
    }
}
