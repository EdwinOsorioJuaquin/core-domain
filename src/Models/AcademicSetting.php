<?php

namespace IncadevUns\CoreDomain\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicSetting extends Model
{
    protected $fillable = [
        'base_grade',
        'min_passing_grade',
        'absence_percentage',
    ];

    protected $casts = [
        'base_grade' => 'integer',
        'min_passing_grade' => 'integer',
        'absence_percentage' => 'decimal:2',
    ];
}
