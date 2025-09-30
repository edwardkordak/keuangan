<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentType extends Model
{
    protected $fillable = ['kode', 'nama'];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'jenis_id');
    }

    public function workflows(): HasMany
    {
        return $this->hasMany(DocumentWorkflow::class, 'document_type_id');
    }
}
