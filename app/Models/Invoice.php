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
        'issue_date',
        'due_date',
        'subtotal',
        'tax_amount',
        'discount',
        'total_amount',
        'minimum_payment',
        'amount_paid',
        'status',
        'notes',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'due_date' => 'date',
            'subtotal' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'discount' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'minimum_payment' => 'decimal:2',
            'amount_paid' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class);
    }

    public static function generateInvoiceNumber(): string
    {
        $date = now()->format('Ymd');
        $lastInvoice = self::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();
        
        $sequence = $lastInvoice ? intval(substr($lastInvoice->invoice_number, -4)) + 1 : 1;
        return 'INV-' . $date . '-' . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    public function updateStatus()
    {
        if ($this->amount_paid >= $this->total_amount) {
            $this->status = 'paid';
            $this->paid_at = now();
        } elseif ($this->amount_paid > 0) {
            $this->status = 'partial';
        } elseif ($this->due_date < now() && $this->amount_paid == 0) {
            $this->status = 'overdue';
        } else {
            $this->status = 'unpaid';
        }
        
        $this->save();
    }

    public function getRemainingBalanceAttribute(): float
    {
        return $this->total_amount - $this->amount_paid;
    }

    public function isOverdue(): bool
    {
        return $this->status === 'overdue' || ($this->due_date < now() && $this->status !== 'paid');
    }
}
