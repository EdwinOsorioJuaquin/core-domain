<?php

namespace IncadevUns\CoreDomain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EnrollmentPayment extends Model
{
    protected $fillable = [
        'enrollment_id',
        'operation_number',
        'agency_number',
        'operation_date',
        'amount',
        'evidence_path',
    ];

    protected $casts = [
        'operation_date' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }
}
