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
        'file_size',
        'type',
        'description',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getTypes(): array
    {
        return [
            'contract' => 'Kontrak',
            'nda' => 'NDA',
            'proposal' => 'Proposal',
            'invoice' => 'Invoice',
            'other' => 'Lainnya',
        ];
    }

    public function getTypeLabelAttribute(): string
    {
        return self::getTypes()[$this->type] ?? $this->type;
    }
}
