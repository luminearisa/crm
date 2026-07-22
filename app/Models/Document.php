<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'title',
        'file_path',
        'file_name',
        'file_mime_type',
        'file_size',
        'type',
        'description',
        'expiry_date',
    ];

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
            'expiry_date' => 'date',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getTypes(): array
    {
        return [
            'contract' => 'Contract',
            'nda' => 'NDA',
            'proposal' => 'Proposal',
            'invoice' => 'Invoice',
            'other' => 'Other',
        ];
    }

    public function getTypeLabelAttribute(): string
    {
        return self::getTypes()[$this->type] ?? $this->type;
    }

    public function isExpired(): bool
    {
        return $this->expiry_date && $this->expiry_date < now();
    }

    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}
