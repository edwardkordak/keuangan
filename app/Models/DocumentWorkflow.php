<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentWorkflow extends Model
{
    protected $fillable = [
        'document_type_id',
        'step_number',
        'step_name',
        'step_description',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }

    public function progresses(): HasMany
    {
        return $this->hasMany(DocumentProgress::class, 'workflow_id');
    }
}
