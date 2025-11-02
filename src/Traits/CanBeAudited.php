<?php

namespace IncadevUns\CoreDomain\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use IncadevUns\CoreDomain\Models\Audit;

trait CanBeAudited
{
    public function audits(): MorphMany
    {
        return $this->morphMany(Audit::class, 'auditable');
    }
}
