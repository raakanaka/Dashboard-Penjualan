<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'contact_person',
        'supplier_code',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the purchases for the supplier.
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    /**
     * Scope a query to only include active suppliers.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the total purchases count for the supplier.
     */
    public function getTotalPurchasesAttribute()
    {
        return $this->purchases()->count();
    }

    /**
     * Get the total amount spent with the supplier.
     */
    public function getTotalSpentAttribute()
    {
        return $this->purchases()->sum('final_amount');
    }

    /**
     * Get the average order value for the supplier.
     */
    public function getAverageOrderValueAttribute()
    {
        $totalPurchases = $this->total_purchases;
        return $totalPurchases > 0 ? $this->total_spent / $totalPurchases : 0;
    }

    /**
     * Get the formatted total spent.
     */
    public function getFormattedTotalSpentAttribute()
    {
        return 'Rp ' . number_format($this->total_spent, 0, ',', '.');
    }

    /**
     * Get the formatted average order value.
     */
    public function getFormattedAverageOrderValueAttribute()
    {
        return 'Rp ' . number_format($this->average_order_value, 0, ',', '.');
    }

    /**
     * Get the last order date for the supplier.
     */
    public function getLastOrderDateAttribute()
    {
        $lastPurchase = $this->purchases()->latest()->first();
        return $lastPurchase ? $lastPurchase->created_at : null;
    }

    /**
     * Get the formatted last order date.
     */
    public function getFormattedLastOrderDateAttribute()
    {
        return $this->last_order_date ? $this->last_order_date->format('M d, Y') : 'Never';
    }
}
