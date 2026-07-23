<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'base_price',
        'is_active',
        'category',
        'unit',
    ];

    protected function casts(): array
    {
        return [
            'base_price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function proposalItems(): HasMany
    {
        return $this->hasMany(ProposalItem::class);
    }

    public static function getCategories(): array
    {
        return [
            'development' => 'Development',
            'design' => 'Design',
            'consulting' => 'Consulting',
            'marketing' => 'Marketing',
            'support' => 'Support',
            'other' => 'Other',
        ];
    }

    public static function getUnits(): array
    {
        return [
            'project' => 'Project',
            'hour' => 'Hour',
            'day' => 'Day',
            'month' => 'Month',
            'year' => 'Year',
            'unit' => 'Unit',
        ];
    }
}
