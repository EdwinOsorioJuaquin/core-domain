<?php

namespace IncadevUns\CoreDomain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FindingEvidence extends Model
{
    protected $fillable = [
        'audit_finding_id',
        'type',
        'path',
    ];

    public function auditFinding(): BelongsTo
    {
        return $this->belongsTo(AuditFinding::class);
    }
}
