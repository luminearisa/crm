<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'subject',
        'description',
        'status',
        'priority',
        'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'resolved_at' => 'datetime',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getStatuses(): array
    {
        return [
            'open' => 'Terbuka',
            'progress' => 'Sedang Dikerjakan',
            'closed' => 'Tertutup',
        ];
    }

    public static function getPriorities(): array
    {
        return [
            'low' => 'Rendah',
            'medium' => 'Sedang',
            'high' => 'Tinggi',
        ];
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'closed' => 'green',
            'progress' => 'blue',
            'open' => 'red',
            default => 'gray',
        };
    }

    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            'high' => 'red',
            'medium' => 'yellow',
            'low' => 'green',
            default => 'gray',
        };
    }
}
