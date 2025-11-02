<?php

namespace IncadevUns\CoreDomain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Forum extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function threads(): HasMany
    {
        return $this->hasMany(Thread::class);
    }
}
