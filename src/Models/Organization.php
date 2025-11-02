<?php

namespace IncadevUns\CoreDomain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    protected $fillable = [
        'ruc',
        'name',
        'type',
        'contact_phone',
        'contact_email',
    ];

    public function agreements(): HasMany
    {
        return $this->hasMany(Agreement::class);
    }
}
