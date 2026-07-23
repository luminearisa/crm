<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lead_id',
        'title',
        'description',
        'due_date',
        'status',
        'priority',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public static function getStatuses(): array
    {
        return [
            'pending' => 'Pending',
            'in_progress' => 'Sedang Dikerjakan',
            'completed' => 'Selesai',
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
            'completed' => 'green',
            'in_progress' => 'blue',
            'pending' => 'yellow',
            default => 'gray',
        };
    }
}
