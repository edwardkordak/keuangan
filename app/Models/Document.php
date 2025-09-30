<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nama_dokumen',
        'jenis_id',
        'tanggal_diterima',
        'file_path',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class, 'jenis_id');
    }

    public function progresses(): HasMany
    {
        return $this->hasMany(DocumentProgress::class);
    }
}
