<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'invoice_number',
        'total_amount',
        'minimum_payment',
        'status',
        'issue_date',
        'due_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'due_date' => 'date',
            'total_amount' => 'decimal:2',
            'minimum_payment' => 'decimal:2',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (empty($invoice->invoice_number)) {
                $date = now()->format('Ymd');
                $count = static::whereDate('created_at', today())->count() + 1;
                $invoice->invoice_number = 'INV-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
            }
            
            // Set minimum payment as 30% of total if not set
            if (empty($invoice->minimum_payment) && $invoice->total_amount > 0) {
                $invoice->minimum_payment = $invoice->total_amount * 0.30;
            }
        });
    }

    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class);
    }

    public static function getStatuses(): array
    {
        return [
            'unpaid' => 'Belum Dibayar',
            'partial' => 'Dibayar Sebagian',
            'paid' => 'Lunas',
        ];
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'paid' => 'green',
            'partial' => 'yellow',
            'unpaid' => 'red',
            default => 'gray',
        };
    }
}
