<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    public function isAgent(): bool
    {
        return $this->role === 'agent';
    }

    // Relationships
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function approvedExpenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'approved_by');
    }

    // Helper methods for statistics
    public function getWonLeadsCountAttribute(): int
    {
        return $this->leads()->where('status', 'won')->count();
    }

    public function getTotalExpectedValueAttribute(): float
    {
        return $this->leads()->where('status', 'won')->sum('expected_value');
    }

    public function getWinRateAttribute(): float
    {
        $total = $this->leads()->count();
        if ($total === 0) {
            return 0;
        }
        return ($this->getWonLeadsCountAttribute() / $total) * 100;
    }
}
