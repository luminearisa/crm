<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'proposal_number',
        'status',
        'issue_date',
        'valid_until',
        'tax_rate',
        'discount',
        'subtotal',
        'tax_amount',
        'total_amount',
        'notes',
        'terms_and_conditions',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'valid_until' => 'date',
            'tax_rate' => 'decimal:2',
            'discount' => 'decimal:2',
            'subtotal' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($proposal) {
            if (empty($proposal->proposal_number)) {
                $date = now()->format('Ymd');
                $count = static::whereDate('created_at', today())->count() + 1;
                $proposal->proposal_number = 'PROP-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ProposalItem::class);
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public static function getStatuses(): array
    {
        return [
            'draft' => 'Draft',
            'sent' => 'Terkirim',
            'accepted' => 'Diterima',
            'rejected' => 'Ditolak',
            'expired' => 'Kadaluarsa',
        ];
    }

    public function calculateTotals()
    {
        $this->subtotal = $this->items->sum(fn($item) => $item->qty * $item->price);
        $this->tax_amount = $this->subtotal * ($this->tax_rate / 100);
        $this->total_amount = $this->subtotal + $this->tax_amount - $this->discount;
        $this->save();
    }
}
