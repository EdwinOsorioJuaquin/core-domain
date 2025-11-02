<?php

namespace IncadevUns\CoreDomain\Models;

use Illuminate\Database\Eloquent\Model;

class StrategicDocument extends Model
{
    protected $fillable = [
        'name',
        'path',
        'type',
        'description',
    ];
}
