<?php

namespace IncadevUns\CoreDomain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AuditFinding extends Model
{
    protected $fillable = [
        'audit_id',
        'description',
        'severity',
        'status',
    ];

    public function audit(): BelongsTo
    {
        return $this->belongsTo(Audit::class);
    }

    public function evidences(): HasMany
    {
        return $this->hasMany(FindingEvidence::class);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(AuditAction::class);
    }
}
