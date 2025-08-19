<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'company_name',
        'commission_rate',
        'is_active'
    ];

    protected $casts = [
        'commission_rate' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function getTotalBudgetAttribute()
    {
        return $this->budgets()->sum('budget_amount');
    }

    public function getTotalSpentAttribute()
    {
        return $this->budgets()->sum('spent_amount');
    }

    public function getRemainingBudgetAttribute()
    {
        return $this->total_budget - $this->total_spent;
    }
}
