<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentProgress extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'document_id',
        'workflow_id',
        'is_checked',
        'checked_at',
        'description',
        'checked_by',
    ];

    protected $casts = [
        'is_checked' => 'boolean',
        'checked_at' => 'datetime',
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function workflow(): BelongsTo
    {
        return $this->belongsTo(DocumentWorkflow::class, 'workflow_id');
    }

    public function checkedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_by');
    }
}
